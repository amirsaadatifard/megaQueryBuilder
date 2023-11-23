<?php

namespace Tests\Units;

use App\Contracts\LoggerInterface;
use App\Helpers\App;
use App\Logger\Logger;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{


    private $logger;

    public function setUp(): void
    {
        $this->logger = new Logger();
        parent::setUp();
    }

    public function testItImplementsTheLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class,new Logger());
    }

    public function testItCanCreateDifferentTypesOfLogLevels()
    {
        $this->logger->info('Testing Info logs');
        $this->logger->error('Testing Error logs');
        $this->logger->log(LogLevel::ALERT,'Testing Alert logs');
        $app = new App;

        $file = sprintf("%s/%s-%s.log", $app->getLogPath(), 'test', date("j.n.Y"));
        self::assertFileExists($file);

        $contentOfLogFile = file_get_contents($file);
        self::assertStringContainsString('Testing Info logs', $contentOfLogFile);
        self::assertStringContainsString('Testing Error logs', $contentOfLogFile);
        self::assertStringContainsString(LogLevel::ALERT, $contentOfLogFile);

        self::assertFileDoesNotExist($file);
//        unlink($contentOfLogFile);

    }
}