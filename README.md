# TSC's Website
The official website of Tech Support Central; mainly HTML with some PHP thrown in and CSS to make everything look pretty<sup>1</sup>.

## Usage
If you want to use this code, because you have to idea how to structure a basic HTML page, this is all you have to do:

1. Make a [Discord Application](https://discord.com/developers/applications) (you can reuse your bot application)
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

<sub>1: Except for mobile devices, unless you have glasses.</sub>
