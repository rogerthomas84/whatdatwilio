<?php
namespace WhatDaTwilio\Sms;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use WhatDaTwilio\Model\ErrorResponseModel;
use WhatDaTwilio\Model\MessageCreatedModel;
use WhatDaTwilio\TwilioConfig;

/**
 * Class SendService
 * @package WhatDaTwilio
 */
class SendService
{
    /**
     * @param string $toNumber
     * @param string $message
     * @return ErrorResponseModel|MessageCreatedModel
     */
    public static function sendMessage($toNumber, $message)
    {
        $config = TwilioConfig::getInstance();
        $url = sprintf(
            'https://api.twilio.com/%s/Accounts/%s/Messages.json',
            $config->getApiVersion(),
            $config->getAccountSid()
        );
        try {
            $cl = new Client();
            $resp = $cl->post(
                $url,
                [
                    'form_params' => [
                        'To' => $toNumber,
                        'From' => $config->getFromNumber(),
                        'Body' => $message
                    ],
                    'auth' => [
                        $config->getAccountSid(),
                        $config->getAuthToken()
                    ]
                ]
            );
            if ($resp->getStatusCode() !== 201) {
                return self::genericFailure(
                    sprintf(
                        'Invalid status code. Expected 201, received: %s',
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

            return MessageCreatedModel::fromApiResponse(
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
