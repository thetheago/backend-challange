<?php

declare(strict_types=1);

namespace Theago\BackendChallange\BeanstalkdJobs\Payment;

use Theago\BackendChallange\Utils\Utils;

class PaymentAuthenticator
{
    static public function isAuthenticated(): bool
    {
        // TODO: Tratar status code diferentes da API
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://util.devi.tools/api/v2/authorize");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            echo 'Erro na requisição cURL: ' . curl_error($ch);
        }

        curl_close($ch);
        $response = json_decode($response, true);

        return $response['data']['authorization'];
    }
}
