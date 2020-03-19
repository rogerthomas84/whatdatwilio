<?php
namespace WhatDaTwilio\Model;

use DateTime;
use Exception;

/**
 * Class MessageCreatedModel
 * @package WhatDaTwilio\Model
 */
class MessageCreatedModel extends BaseModel
{
    /**
     * @var string
     */
    protected $sid;

    /**
     * @var DateTime
     */
    protected $date_created;

    /**
     * @var DateTime
     */
    protected $date_updated;

    /**
     * @var DateTime|null
     */
    protected $date_sent;

    /**
     * @var string
     */
    protected $account_sid;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string|null
     */
    protected $messaging_service_sid;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $num_segments;

    /**
     * @var string
     */
    protected $num_media;

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var string
     */
    protected $api_version;

    /**
     * @var string|null
     */
    protected $price;

    /**
     * @var string|null
     */
    protected $error_code;

    /**
     * @var string|null
     */
    protected $error_message;

    /**
     * @var string|null
     */
    protected $uri;

    /**
     * @var array
     */
    protected $subresource_uris;

    /**
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * @return DateTime|null
     */
    public function getDateSent()
    {
        return $this->date_sent;
    }

    /**
     * @return string
     */
    public function getAccountSid()
    {
        return $this->account_sid;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return string|null
     */
    public function getMessagingServiceSid()
    {
        return $this->messaging_service_sid;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getNumSegments()
    {
        return $this->num_segments;
    }

    /**
     * @return string
     */
    public function getNumMedia()
    {
        return $this->num_media;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->api_version;
    }

    /**
     * @return string|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string|null
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * @return string|null
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getSubresourceUris()
    {
        return $this->subresource_uris;
    }

    /**
     * @param array $data
     * @return self
     * @throws Exception
     */
    public static function fromApiResponse(array $data)
    {
        $clz = get_called_class();
        $instance = new $clz();
        foreach ($data as $k => $v) {
            $value = $v;
            if (in_array($k, ['date_created', 'date_updated', 'date_sent'])) {
                if ($v !== null) {
                    $value = new DateTime($v);
                }
            }
            $instance->{$k} = $value;
        }

        return $instance;
    }
}
