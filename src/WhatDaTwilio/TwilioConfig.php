<?php
namespace WhatDaTwilio;

/**
 * Class TwilioConfig
 * @package WhatDaTwilio
 */
class TwilioConfig
{
    /**
     * Holds the static instance of this object.
     *
     * @var TwilioConfig
     */
    protected static $_instance = null;

    /**
     * @var string
     */
    private $accountSid = null;

    /**
     * @var string
     */
    private $authToken = null;

    /**
     * @var string
     */
    private $fromNumber = null;

    /**
     * @var string
     */
    private $phpUnitToNumber = null;

    /**
     * @var string
     */
    private $apiVersion = '2010-04-01';

    /**
     * Construct the instance, protected to avoid accidental `new` instances.
     */
    protected function __construct()
    {
    }

    /**
     * @return string
     */
    public function getAccountSid()
    {
        return $this->accountSid;
    }

    /**
     * @param string $accountSid
     * @return TwilioConfig
     */
    public function setAccountSid($accountSid)
    {
        $this->accountSid = $accountSid;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     * @return TwilioConfig
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromNumber()
    {
        return $this->fromNumber;
    }

    /**
     * @param string $fromNumber
     * @return TwilioConfig
     */
    public function setFromNumber($fromNumber)
    {
        $this->fromNumber = $fromNumber;
        return $this;
    }

    /**
     * Get the number to send to in PHP Unit Tests
     * @return string
     */
    public function getPhpUnitToNumber()
    {
        return $this->phpUnitToNumber;
    }

    /**
     * Set the number to send to in PHP Unit Tests
     *
     * @param string $phpUnitToNumber
     * @return TwilioConfig
     */
    public function setPhpUnitToNumber($phpUnitToNumber)
    {
        $this->phpUnitToNumber = $phpUnitToNumber;
        return $this;
    }

    /**
     * The API version to use. Defaults to 2010-04-01
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     * @return TwilioConfig
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    /**
     * Retrieve the static instance of this object
     *
     * @return TwilioConfig
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }
}
