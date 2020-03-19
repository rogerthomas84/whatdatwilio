WhatDaTwilio
============

WhatDaTwilio is a simple message sending library for the Twilio API written in PHP.

Installation...
---------------

Make sure you have these elements in your `composer.json` file:

```
    "repositories":[
        {
            "type": "vcs",
            "url": "git@github.com:rogerthomas84/whatdatwilio.git"
        }
    ],
    
    // More composer content.

    "require": {
        "rogerthomas84/whatdatwilio": ">=1.0.0"
    }
```

Configuration...
----------------

All configuration is set up in the singleton class `\WhatDaTwilio\TwilioConfig`

In this example below, we provide the required information. Optionally you can set the api version using `setApiVersion`
but this defaults to `2010-04-01` and hasn't changed on Twilio's side in years.

```php
<?php
\WhatDaTwilio\TwilioConfig::getInstance()->setAccountSid(
    '<the account sid>'
)->setAuthToken(
    '<the auth token>'
)->setPhpUnitToNumber(
    '<to number>' // in +441234567890 format
)->setFromNumber(
    '<from number>' // in +441234567890 format
);

```

Sending a message...
--------------------

```php
<?php
$sent = \WhatDaTwilio\Sms\SendService::sendMessage(
    '<number to send to>', // in +441234567890 format
    'Your message here!'
);
if ($sent->isError()) {
    // message failed
} else {
    // message was sent
    echo 'Message was sent with sid of: ' . $sent->getSid();
}
```

Checking the status...
----------------------

```php
<?php
$status = \WhatDaTwilio\Sms\StatusService::getStatus(
    '<send message sid>' // for example $sent->getSid()
);
if ($status->isError()) {
    // status retrieval failed
} else {
    // status was retrieved
    echo 'Message status is: ' . $status->getStatus();
}
```

Unit testing...
---------------

To run unit tests, install the composer dependencies and issue the following command:

`$ ./vendor/bin/phpunit -c phpunit.xml`
