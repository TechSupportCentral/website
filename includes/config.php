<?php
$client_id = "Insert client ID here";
$secret_id = "Insert client secret here";
$webhook_url = "Insert webhook url here";
$db_file = "/path/to/database.sqlite";
$site_root = "https://www.techsupportcentral.org/";

$application_questions = [
    "mod1" => [
        "q" => "If a member is doing something against our rules (i.e. spamming, sending NSFW), what should you do?",
        "type" => "radio",
        "op1" => "Leave it and see what happens",
        "op2" => "Mute the member",
        "op3" => "Ban the member",
        "op4" => "Issue a warning"
    ],
    "mod2" => [
        "q" => "If you or another member sees someone advertising, what should you do?",
        "type" => "radio",
        "op1" => "Do nothing",
        "op2" => "Mute the member",
        "op3" => "Ban the member",
        "op4" => "Issue a warning"
    ],
    "mod3" => [
        "q" => "If a member asks for help or advice with cracked/illegal content, what should you do?",
        "type" => "radio",
        "op1" => "Do nothing",
        "op2" => "Ban the member",
        "op3" => "Warn the member; in the warn message, let them know about our rules.",
        "op4" => "Inform the member publicly of our rules and that we cannot offer any help."
    ],
    "mod4" => [
        "q" => "We ask you to enable Discord's Developer Mode so you can easily retrieve a user's ID.",
        "type" => "radio",
        "op1" => "I understand; I will enable developer mode.",
        "op2" => "I understand; I am unsure how to, so a staff member must show me how to enable this."
    ],
    "mod5" => [
        "q" => "If your application gets accepted, you will temporarily have a \"Trial Moderator\" role with less permissions.",
        "type" => "boolean"
    ],
    "mod6" => [
        "q" => "Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form.",
        "type" => "boolean"
    ],
    "mod7" => [
        "q" => "As a moderator, you will have to adhere and follow the rules.",
        "type" => "boolean"
    ],
    "sp1" => [
        "q" => "Are you currently or have you previously provided Tech Support in any other discord servers or a real life career?",
        "type" => "radio",
        "op1" => "Yes, I currently do.",
        "op2" => "I have in the past.",
        "op3" => "I have in the past."
    ],
    "sp2" => [
        "q" => "Are you able to be active on the server at least 2-3 times a week?",
        "type" => "radio",
        "op1" => "Yes",
        "op2" => "No"
    ],
    "sp3" => [
        "q" => "What do you specialize in?",
        "type" => "checkbox",
        "op1" => "Software",
        "op2" => "Hardware",
        "op3" => "PC Builds",
        "op4" => "Mobile",
        "op5" => "Networking",
        "op6" => "Linux"
    ],
    "sp4" => [
        "q" => "Are you confident in giving advice and offering support?",
        "type" => "radio",
        "op1" => "Yes",
        "op2" => "No"
    ],
    "sp5" => [
        "q" => "Are you okay with notifying other Support Team members if you are unsure how to deal with a case that you are involved in?",
        "type" => "radio",
        "op1" => "Yes",
        "op2" => "No"
    ]
];