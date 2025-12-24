<?php
require "../includes/config.php";

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
        if ($question['type'] == 'radio') {
            $field['value'] = $question['op' . $_POST[$questionName]];
        } elseif ($question['type'] == 'checkbox') {
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
        } elseif ($question['type'] == 'boolean') {
            if (isset($_POST[$questionName])) {
                $field['value'] = 'I understand.';
            }
        } else {
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
echo $response;

// TODO: DB interaction and redirecting