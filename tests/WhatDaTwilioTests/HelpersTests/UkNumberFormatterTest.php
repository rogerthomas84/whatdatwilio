<?php
namespace WhatDaTwilioTests\HelperTests;

use PHPUnit\Framework\TestCase;
use WhatDaTwilio\Helper\NumberFormatter;


/**
 * Class NumberFormatterTest
 * @package WhatDaTwilioTests\HelperTests
 */
class UkNumberFormatterTest extends TestCase
{
    public function testValidUkNumberFormats()
    {
        $formats = [
            '07123456789',
            '07123 456789',
            '07123 456 789',
            '0 7123 456 789',
            '447123456789',
            '447123 456789',
            '447123 456789',
            '44 7123 456 789',
            '+447123456789',
            '+447123 456789',
            '+447123 456789',
            '+44 7123 456 789',
        ];
        foreach ($formats as $format) {
            $this->assertNotFalse(NumberFormatter::cleanseUkMobile($format));
        }
    }

    public function testInvalidUkNumberFormats()
    {
        $formats = [
            'GB07123456789',
            'GB07123 456789',
            'GB07123 456 789',
            'GB0 7123 456 789',
            'GB7123456789',
            'GB7123 456789',
            'GB7123 456789',
            'GB 7123 456 789',
            '+GB7123456789',
            '+GB7123 456789',
            '+GB7123 456789',
            '+GB 7123 456 789',
            // To long below
            '071234567892',
            '07123 4567892',
            '07123 456 7892',
            '0 7123 456 7892',
            '4471234567892',
            '447123 4567892',
            '447123 4567892',
            '44 7123 456 7892',
            '+4471234567892',
            '+447123 4567892',
            '+447123 4567892',
            '+44 7123 456 7892',
        ];
        foreach ($formats as $format) {
            $this->assertFalse(NumberFormatter::cleanseUkMobile($format));
        }
    }
}
