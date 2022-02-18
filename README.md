# TSC's Website
The official website of Tech Support Central; mainly HTML with some PHP thrown in and CSS to make everything look pretty.

## Usage
If for some reason you want to use this code, this is all you have to do:

1. Make a [Discord Application](https://discord.com/developers/applications) (if you have a bot, you can reuse that application).
2. Make a [webhook](https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks) in the Discord channel that you want to receive new staff applications and ban appeals in.
3. Enter the appropriate values in [config.php](includes/config.php).

config.php:
```php
<?php
$client_id = "Client ID from the application";
$secret_id = "Client Secret from the application";
$webhookurl = "URL from the webhook";
?>
```
