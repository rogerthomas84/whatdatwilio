<?php
namespace WhatDaTwilioTests;

use PHPUnit\Framework\TestCase;
use WhatDaTwilio\Model\MessageCreatedModel;
use WhatDaTwilio\Model\MessageStatusModel;
use WhatDaTwilio\Sms\StatusService;
use WhatDaTwilio\TwilioConfig;
use WhatDaTwilio\Sms\SendService;

/**
 * Class BasicSendTest
 * @package WhatDaTwilioTests
 */
class BasicSendTest extends TestCase
{
    public function testBasicSend()
    {
        $this->markTestSkipped('Skipping.');
        return;
        $sent = SendService::sendMessage(
            TwilioConfig::getInstance()->getPhpUnitToNumber(),
            'Hello!'
        );
        $this->assertFalse($sent->isError());
        $this->assertInstanceOf(MessageCreatedModel::class, $sent);

        sleep(1);

        $status = StatusService::getStatus($sent->getSid());
        $this->assertFalse($status->isError());
        $this->assertInstanceOf(MessageStatusModel::class, $status);
    }
}
