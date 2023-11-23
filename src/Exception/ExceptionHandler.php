<?php

declare(strict_types = 1);


namespace App\Exception;

use App\Helpers\App;
use Throwable;
use ErrorException;

class ExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $app = new App;
        if($app->isDebugMode()){
            echo '<pre>';
            var_dump($exception);
            echo '</pre>';
        }else{
            echo "This should not have happened , please try again !";
        }
        exit;
    }

    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file , $line);
    }
}