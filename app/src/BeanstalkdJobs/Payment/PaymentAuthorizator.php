<?php

declare(strict_types=1);

namespace Theago\BackendChallange\BeanstalkdJobs\Payment;

use Theago\BackendChallange\Exceptions\ServiceIndisponibleException;

class PaymentAuthorizator
{
    public static function isAuthorizated(): bool
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://util.devi.tools/api/v2/authorize");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Erro na requisição cURL: ' . curl_error($ch);
                throw new ServiceIndisponibleException('Authentiction service is not disponible');
            }

            curl_close($ch);
            $response = json_decode($response, true);

            return $response['data']['authorization'];
        } catch (\Throwable $e) {
            throw new ServiceIndisponibleException($e->getMessage());
        }
    }
}
