<?php
namespace WhatDaTwilio\Sms;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use WhatDaTwilio\Model\ErrorResponseModel;
use WhatDaTwilio\Model\MessageCreatedModel;
use WhatDaTwilio\Model\MessageStatusModel;
use WhatDaTwilio\TwilioConfig;

/**
 * Class StatusService
 * @package WhatDaTwilio
 */
class StatusService
{
    /**
     * @param string $sid
     * @return ErrorResponseModel|MessageCreatedModel
     */
    public static function getStatus($sid)
    {
        $config = TwilioConfig::getInstance();
        $url = sprintf(
            'https://api.twilio.com/%s/Accounts/%s/Messages/%s/.json',
            $config->getApiVersion(),
            $config->getAccountSid(),
            $sid
        );
        try {
            $cl = new Client();
            $resp = $cl->get(
                $url,
                [
                    'auth' => [
                        $config->getAccountSid(),
                        $config->getAuthToken()
                    ]
                ]
            );
            if ($resp->getStatusCode() !== 200) {
                return self::genericFailure(
                    sprintf(
                        'Invalid status code. Expected 200, received: %s',
                        $resp->getStatusCode()
                    )
                );
            }

            $body = $resp->getBody()->__toString();
            if (!$body || false === $decoded = @json_decode($body, true)) {
                return self::genericFailure(
                    'Failed decoding body.'
                );
            }

            return MessageStatusModel::fromApiResponse(
                $decoded
            );

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $body = $e->getResponse()->getBody()->__toString();
                if (false !== $decoded = @json_decode($body, true)) {
                    return ErrorResponseModel::fromApiResponse($decoded);
                }
            }
        } catch (Exception $ee) {
            return self::genericFailure(
                sprintf(
                    '%s::%s',
                    get_class($ee),
                    $ee->getMessage()
                )
            );
        }

        return self::genericFailure(
            'Failure without valid response body.'
        );
    }

    /**
     * @param string $message
     * @return ErrorResponseModel
     */
    protected static function genericFailure($message)
    {
        return ErrorResponseModel::fromApiResponse([
            'code' => 99999,
            'message' => $message,
            'more_info' => 'not available',
            'status' => 500
        ]);
    }
}
