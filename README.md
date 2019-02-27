# Textline PHP

## Setup

Using composer:

```bash
composer require dbatten5/textline-php
```

## Usage

### Authentication

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

If the api key and/or token are incorrect a `Textline\Exceptions\AuthenticationException` will be thrown.

### Conversations

#### List conversations

```php
$client->conversations()
       ->get();
```
To add query parameters listed [here](https://textline.docs.apiary.io/#reference/conversations/conversations/list-conversations) pass in an array of key values:

```php
$query = [
    'page' => 1,
    'page_size' => 20,
    'query' => 'foo',
];

$client->conversations()
       ->get($query);
```

### Conversation

#### Retrieve a conversation

```php
$uuid = 'abc-123';

$client->conversations()
       ->retrieve($uuid);
```

To add query parameters listed [here](https://textline.docs.apiary.io/#reference/conversations/conversation/retrieve-a-conversation) pass in an array of key values as the second argument.


#### Message a conversation

Pass in the conversation uuid as the first argument and the message attributes as the second argument:

```php
$uuid = 'abc-123';
$body = [
    'comment' => [
        'body' => 'foo',
    ],
    'whisper' => [
        'body' => 'bar',
    ]
];

$client->conversation()
       ->message($uuid, $body);
```
