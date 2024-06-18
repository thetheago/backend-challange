<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Utils;

class Utils
{
    public static function dd(mixed $data_to_dump, bool $pretty = false): void
    {
        $pretty ? print("<pre>".print_r($data_to_dump,true)."</pre>") : var_dump($data_to_dump);
        die();
    }
}