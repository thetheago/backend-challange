<?php

namespace Theago\BackendChallange\Responses;

class HeaderResponseStatusCode
{
    public static function getHeaderCode(int $code): string
    {
        $http_version = 'HTTP/1.1';

        return match ($code) {
            200 => $http_version . ' 200 Ok',
            201 => $http_version . ' 201 Created',
            400 => $http_version . ' 400 Bad Request',
            405 => $http_version . ' 405 Method Not Allowed',
            404 => $http_version . ' 404 Not Found',
            422 => $http_version . ' 422 Unprocessable Entity',
            500 => $http_version . ' 500 Internal Server Error',
        };
    }
}
