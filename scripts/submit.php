<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/config.php";

// Redirect to result page when finished
function redirect($status): void {
    echo "<script>
        window.onload = function() {
            // Make a fake form to do a POST redirect
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '../result.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            input.value = '$status';
            form.appendChild(input);
            // Add form to document and immediately submit
            document.body.appendChild(form);
            form.submit();
        }
    </script>";
}

// Build Discord embed
$thumbnail = "https://cdn.discordapp.com/avatars/" . $_POST['id'] . "/" . $_POST['avatar'] . $_POST['extension'];
$fields = [
    [
        "name" => "Submitted by:",
        "value" => $_POST['username'],
        "inline" => true
    ],
    [
        "name" => "User ID",
        "value" => $_POST['id'],
        "inline" => true
    ]
];
if ($_POST['type'] == 'mod') {
    $title = "New Moderator Application";
    $color = 0x3498db;
} elseif ($_POST['type'] == 'sp') {
    $title = "New Support Team Application";
    $color = 0x4df352;
}
if ($_POST['type'] == 'appeal') {
    $title = "Ban Appeal";
    $color = 0xe74c3c;
    $fields[] = [
        "name" => "Contact Email",
        "value" => $_POST['email'],
        "inline" => false
    ];
    $fields[] = [
        "name" => "Stated reason for Ban",
        "value" => $_POST['reason'],
        "inline" => false
    ];
    $fields[] = [
        "name" => "Appeal for Ban",
        "value" => $_POST['appeal'],
        "inline" => false
    ];
} else {
    foreach ($application_questions as $questionName => $question) {
        if (!str_starts_with($questionName, $_POST['type'])) continue;
        $field = [
            "name" => $question['q']
        ];
        switch ($question['type']) {
            case 'radio':
                $field['value'] = $question['op' . $_POST[$questionName]];
                break;
            case 'checkbox':
                $field['value'] = "";
                foreach ($question as $optionName => $optionText) {
                    if (isset($_POST[$questionName . $optionName])) {
                        $field['value'] .= ', ' . $optionText;
                    }
                }
                if ($field['value'] == "") {
                    $field['value'] = "None";
                } else {
                    $field['value'] = substr($field['value'], 2);
                }
                break;
            case 'boolean':
                if (isset($_POST[$questionName])) {
                    $field['value'] = 'I understand.';
                }
                break;
            default:
                $field['value'] = "Unknown";
        }
        $field["inline"] = false;
        $fields[] = $field;
    }
}

// Send Discord embed
$json_data = json_encode([
    "embeds" => [
        [
            "title" => $title,
            "type" => "rich",
            "color" => $color,
            "thumbnail" => ["url" => $thumbnail],
            "fields" => $fields
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if ($response != '') {
    redirect('embedFail');
}

// Open DB
try {
    $db = new SQLite3($db_file);
    $db->enableExceptions(true);
} catch (SQLite3Exception $e) {
    redirect('dbOpenFail');
}

// Form DB query
$query = "INSERT into ";
if ($_POST['type'] == 'appeal') {
    $query .= 'ban_appeals VALUES (:id, :email, :time, :status, :reason, :appeal);';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':time', time());
    $stmt->bindValue(':status', 'pending');
    $stmt->bindValue(':reason', $_POST['reason']);
    $stmt->bindValue(':appeal', $_POST['appeal']);
} else {
    $query .= 'staff_applications VALUES (?, ?, ?, ?';
    $values = [$_POST['id'], time(), $_POST['type'], 'pending'];
    forEach ($application_questions as $questionName => $question) {
        if (!str_starts_with($questionName, $_POST['type'])) continue;
        $query .= ', ?';
        switch ($question['type']) {
            case 'radio':
                $values[] = $_POST[$questionName];
                break;
            case 'checkbox':
                $value = "";
                foreach ($question as $optionName => $optionText) {
                    if (isset($_POST[$questionName . $optionName])) {
                        $value .= ', ' . $optionText;
                    }
                }
                if ($value == "") {
                    $value = "None";
                } else {
                    $value = substr($value, 2);
                }
                $values[] = $value;
                break;
            case 'boolean':
                if (isset($_POST[$questionName])) {
                    $values[] = 'true';
                } else {
                    $values[] = 'false';
                }
                break;
            default:
                $values[] = "Unknown";
        }
    }
    // Fill query up to 10 questions (unanswered questions are NULL)
    for ($i = count($values) + 1; $i <= 13; $i++) {
        $query .= ', ?';
        $values[] = null;
    }
    $query .= ');';
    // Insert values into query
    $stmt = $db->prepare($query);
    for ($i = 0; $i < count($values); $i++) {
        $stmt->bindValue($i + 1, $values[$i]);
    }
}

// Execute DB query and close DB
try {
    $stmt->execute();
    $stmt->close();
    $db->close();
} catch (SQLite3Exception $e) {
    redirect('dbExecFail');
}

if ($_POST['type'] == 'appeal') {
    redirect('appealSuccess');
} else {
    redirect('applySuccess');
}