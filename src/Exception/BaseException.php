<?php

declare(strict_types = 1);

namespace App\Exception;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{

    protected array $data = [];

    public function __construct(string $message = "", array $data = [], int $code = 0, Throwable $prev = null)
    {
        $this->data = $data;
        parent::__construct($message,$code,$prev);
    }

    public function setData (string $key , $value): void
    {
        $this->data[$key] = $value;
    }

    public function getExtraData (): array
    {
        if(count($this->data) === 0){
            return [];
        }
        return json_decode(json_encode($this->data),true);
    }

}