<?php
namespace WhatDaTwilio\Model;

/**
 * Class BaseModelModel
 * @package WhatDaTwilio\Model
 */
abstract class BaseModel
{
    /**
     * Is this an error response?
     *
     * @return bool
     */
    public function isError()
    {
        return false;
    }
}
