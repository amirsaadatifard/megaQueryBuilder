<?php

namespace Tests\Units;

use App\Contracts\DatabaseConnectionInterface;
use App\Database\MySQLiConnection;
use App\Database\PDOConnection;
use App\Exception\MissingArgumentException;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;


class DatabaseConnectionTest extends TestCase
{

    public function testItThrowsMissingArgumentsExceptionWithWrongCredentialKeys()
    {
        self::expectException(MissingArgumentException::class);
        $credentials = [];
        $pdoHandler = new PDOConnection($credentials);
        return $pdoHandler;
    }

    public function testItCanConnectToDatabaseWithPdoApi()
    {
        $credentials = $this->getCredentials('pdo');
        $pdoHandler = (new PDOConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class,$pdoHandler);
        return $pdoHandler;
    }

    /**
     * @depends testItCanConnectToDatabaseWithPdoApi
     */
    public function testItAValidPdoConnection(DatabaseConnectionInterface $handler)
    {

        self::assertInstanceOf(\PDO::class,$handler->getConnection());
    }

    private function getCredentials(string $type)
    {
        return array_merge(
            Config::get('database',$type),
            ['db_name'   => 'bug']
        );
    }

    public function testItCanConnectToDatabaseWithMysqliApi()
    {
        $credentials = $this->getCredentials('mysqli');
        $pdoHandler = (new MySQLiConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class,$pdoHandler);
        return $pdoHandler;
    }

    /**
     * @depends testItCanConnectToDatabaseWithMysqliApi
     */
    public function testItAValidMysqliConnection(DatabaseConnectionInterface $handler)
    {

        self::assertInstanceOf(\mysqli::class,$handler->getConnection());
    }

}