<?php

declare(strict_types = 1);

namespace App\Helpers;

use DateTimeInterface , DateTime , DateTimeZone;

class App
{

    private array $config = [];

    public function __construct()
    {
        $this->config = Config::get('app');
    }

    public function isDebugMode(): bool {

        if(!isset($this->config['debug'])){
            return false;
        }
        return $this->config['debug'];
    }

    public function getEnvironment(): string
    {
        if(!isset($this->config['env'])){
            return 'production';
        }
        return $this->config['env'];
    }

    public function getLogPath(): string
    {
        if(!isset($this->config['log_path'])){
            throw new \Exception('Log path not defined !');
        }
        return $this->config['log_path'];
    }

    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpbg';
    }

    public function getServeTime(): DateTimeInterface
    {
        return new DateTime('now',new DateTimeZone($this->config['timezone']));
    }

}