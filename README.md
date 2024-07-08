# TSC's Website
The official website of Tech Support Central.

## Usage
If for some reason you want to use this code, here is the setup:

1. Install PHP with MongoDB and CURL extensions.
2. Install [Composer](https://getcomposer.org/) and run `composer install`.
3. Make a [Discord Application](https://discord.com/developers/applications) (if you have a bot, you can reuse that application).
4. Make a [webhook](https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks) in the Discord channel where new staff applications and ban appeals will be sent.
5. Make a MongoDB database (to track staff applications and ban appeals) with an "applications" collection.
6. Enter the appropriate values in [config.php](includes/config.php).

config.php:
```php
<?php
require_once 'vendor/autoload.php'; // Load MongoDB PHP library

$client_id   = "Client ID from the application";
$secret_id   = "Client Secret from the application";
$webhook_url = "URL from the webhook";
$mongo_db    = "MongoDB database name";
$mongo_uri   = "MongoDB connection URI";
?>
```
