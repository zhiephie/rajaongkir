<?php
namespace Zhiephie;

use Exception;

class InvalidException extends Exception
{
    public static function apiKey($apiKey)
    {
        return new static('Invalid Api Key' . $apiKey);
    }

    public static function accountType($accountType)
    {
        return new static('Invalid Account Type' . $accountType);
    }

    public static function notFound()
    {
        return new static('Page Not Found!');
    }

    public function argumentRequired($param)
    {
        return new static("$param is required");
    }

    public function unsupported($type)
    {
        return new static('Unsupported Account '. $type);
    }
}
