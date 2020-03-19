<?php
namespace WhatDaTwilio\Model;

/**
 * Class ErrorResponseModel
 * @package WhatDaTwilio\Model
 */
class ErrorResponseModel extends BaseModel
{
    /**
     * @var int
     */
    public $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $more_info;

    /**
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getMoreInfo()
    {
        return $this->more_info;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Is this an error response?
     *
     * @return bool
     */
    public function isError()
    {
        return true;
    }

    /**
     * @param array $data
     * @return ErrorResponseModel
     */
    public static function fromApiResponse(array $data)
    {
        $instance = new ErrorResponseModel();
        foreach ($data as $k => $v) {
            $instance->{$k} = $v;
        }

        return $instance;
    }
}
