<?php
namespace WhatDaTwilio\Helper;

/**
 * Class NumberFormatter
 * @package WhatDaTwilio\Helper
 */
class NumberFormatter
{
    /**
     * @param string $provided
     * @return bool|mixed|string
     */
    public static function cleanseUkMobile($provided)
    {
        if (null === $provided || strlen($provided) === 0) {
            return false;
        }
        $provided = trim($provided);
        $provided = str_replace(' ', '', $provided);
        if (substr($provided, 0, 2) === '07') {
            // 07812
            $provided = '+44' . substr($provided, 1);
        }
        if (substr($provided, 0, 3) === '447') {
            $provided = '+' . $provided;
        }
        if (substr($provided, 0, 4) === '4407') {
            $provided = '+447' . substr($provided, 4);
        }
        $withoutPlus = substr($provided, 1);
        if (ctype_digit($withoutPlus) !== true) {
            return false;
        }
        if (strlen($provided) !== 13) {
            return false;
        }
        return $provided;
    }
}
