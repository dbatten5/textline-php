# Textline PHP

## Setup

Using composer:

```bash
composer require dbatten5/textline-php
```

## Usage

#### Authentication

When initializing the client you must provide your api key (obtained
[here](https://application.textline.com/organization/api_settings)) and email
and password of the agent you want represented by your API requests. This will
make a request to the Textline API to retrieve an authentication token. If you
already know you token you may pass it in as the fourth argument.

```php
<?php
$apiKey = "ZZZZZZZZ"; // Your account api key
$email = "agent@acme.com"; // Email address of the agent
$password = "XXXXXX"; // Password associated with the email address above
$token = 'YYYYYYYY'; // Can be left blank to make a request to get the token

$client = new Textline\Client($email, $password, $apiKey, $token);
```
