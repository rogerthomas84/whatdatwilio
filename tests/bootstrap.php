<?php
if (!file_exists(__DIR__ . '/../test.credentials.php')) {
    echo 'test.credentials.php file does not exist. Please read the README.md';
    exit(1);
}

include __DIR__ . '/../vendor/autoload.php';

$settings = include __DIR__ . '/../test.credentials.php';

\WhatDaTwilio\TwilioConfig::getInstance()->setAccountSid(
    $settings['accountSid']
)->setAuthToken(
    $settings['authToken']
)->setPhpUnitToNumber(
    $settings['toNumber']
)->setFromNumber(
    $settings['fromNumber']
);
