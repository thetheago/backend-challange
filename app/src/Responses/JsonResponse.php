<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Responses;

use Theago\BackendChallange\Utils\Utils;

class JsonResponse
{
    private string $response;

    public function __construct(int $status, array $data = [])
    {
        header('Content-Type: application/json');
        header(HeaderResponseStatusCode::getHeaderCode($status));
        if (!empty($data)) {
            $this->response = json_encode($data);
            return;
        }

        $this->response = '';
    }

    public function __toString(): string
    {
        return $this->response;
    }
}
