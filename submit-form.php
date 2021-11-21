<?php
require 'includes/config.php';
$thumbnail = "https://cdn.discordapp.com/avatars/";
$thumbnail .= $_GET['id'];
$thumbnail .= "/";
$thumbnail .= $_GET['avatar'];
$thumbnail .= $_GET['extension'];

if ($_GET['type'] == "support_team") {
    $title = "New Support Team Application";
    $color = hexdec("4df352");
    $fields = [
        [
            "name" => "Submitted by:",
            "value" => $_GET['username'],
            "inline" => true
        ],
        [
            "name" => "User ID:",
            "value" => $_GET['id'],
            "inline" => true
        ],
        [
            "name" => "Are you currently or have you previously provided Tech Support in any other discord servers or a real life career?",
            "value" => $_GET['q1'],
            "inline" => false
        ],
        [
            "name" => "Are you able to be active on the server at least 2-3 times a week?",
            "value" => $_GET['q2'],
            "inline" => false
        ],
        [
            "name" => "What do you specialize in?",
            "value" => $_GET['q3'],
            "inline" => false
        ],
        [
            "name" => "Are you confident in giving advice and offering support?",
            "value" => $_GET['q4'],
            "inline" => false
        ],
        [
            "name" => "Are you okay with notifying other Support Team members if you are unsure with how to deal with a case that you are involved in?",
            "value" => $_GET['q5'],
            "inline" => false
        ]
    ];
} elseif ($_GET['type'] == "moderator") {
    $title = "New Moderator Application";
    $color = hexdec("3498db");
    $fields = [
        [
            "name" => "Submitted by:",
            "value" => $_GET['username'],
            "inline" => true
        ],
        [
            "name" => "User ID:",
            "value" => $_GET['id'],
            "inline" => true
        ],
        [
            "name" => "If a member is doing something against our rules (i.e. spamming, sending NSFW), what do you do?",
            "value" => $_GET['q1'],
            "inline" => false
        ],
        [
            "name" => "If you or another member receives self promotion, what do you do?",
            "value" => $_GET['q2'],
            "inline" => false
        ],
        [
            "name" => "If a member asks for help or advice with cracked/illegal content, what do you do?",
            "value" => $_GET['q3'],
            "inline" => false
        ],
        [
            "name" => "We ask you to enable Developer Mode in Discord settings so you can retrieve a user ID to make it easier to sanction a member.",
            "value" => $_GET['q4'],
            "inline" => false
        ],
        [
            "name" => "If your Mod application gets accepted, you will temporarily receive a \"Trial Moderator\" role which is a trial period to see if this role is for you.",
            "value" => $_GET['q5'],
            "inline" => false
        ],
        [
            "name" => "Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form.",
            "value" => $_GET['q6'],
            "inline" => false
        ],
        [
            "name" => "As a moderator, you will have to adhere and follow the rules.",
            "value" => $_GET['q7'],
            "inline" => false
        ]
    ];
} elseif ($_GET['type'] == "appeal") {
    $title = "New Ban Appeal";
    $color = hexdec("e74c3c");
    $fields = [
        [
            "name" => "Submitted by:",
            "value" => $_GET['username'],
            "inline" => true
        ],
        [
            "name" => "User ID:",
            "value" => $_GET['id'],
            "inline" => true
        ],
        [
            "name" => "Contact Email:",
            "value" => $_GET['email'],
            "inline" => false
        ],
        [
            "name" => "Why were you banned?",
            "value" => $_GET['q1'],
            "inline" => false
        ],
        [
            "name" => "Why do you disagree with the reasoning for your ban?",
            "value" => $_GET['q2'],
            "inline" => false
        ]
    ];
}

$json_data = json_encode([
    "embeds" => [
        [
            "title" => $title,
            "type" => "rich",
            "color" => $color,
            "thumbnail" => [
                "url" => $thumbnail
            ],
            "fields" => $fields
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

if ($response == "") {
    $success = "done";
} else {
    $success = "fail";
}

if ($_GET['type'] == "support_team") {
    header('Location: support-team.php?form='.$success);
} elseif ($_GET['type'] == "moderator") {
    header('Location: moderator.php?form='.$success);
} elseif ($_GET['type'] == "appeal") {
    header('Location: appeal.php?form='.$success);
} else {
    header('Location: index.php');
}

?>
