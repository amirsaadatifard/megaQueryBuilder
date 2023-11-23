<?php

namespace Tests\Units;

use App\Database\PDOConnection;
use App\Database\QueryBuilder;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{

    /** @var QueryBuilder $queryBuilder */

    private $queryBuilder;

    public function setUp(): void
    {
        $pdo = new PDOConnection(Config::get('database','pdo'),
            ['db_name'   => 'bug']);
        $this->queryBuilder = new QueryBuilder($pdo->connect());
        parent::setUp();
    }

    public function testBindings()
    {
        $query = $this->queryBuilder->where('id',7)->where('report_type','>=','100');
        self::assertIsArray($query->getPlaceholders());
        self::assertIsArray($query->getBindings());
        var_dump($query->getBindings(), $query->getPlaceholders());
        exit();
    }

    public function testItCanCreateRecords()
    {

        $id = $this->queryBuilder->table('reports')->create($data);
        self::assertNotNull($id);
    }

    public function testItCanPerformRowQuery()
    {
        $result = $this->queryBuilder->raw("SELECT * FROM reports");
        self::assertNotNull($result);
    }

    public function testItCanPerformSelectQuery()
    {
        $results = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id','=',1)
            ->first();
        self::assertNotNull($results);
        self::assertSame(1,(int)$results->id);
    }

    public function testItCanPerformSelectQueryWithMultipleWhereClause()
    {
        $results = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id','=',1)->where('report_type','=','Report Type 1')
            ->first();
        self::assertNotNull($results);
        self::assertSame(1,(int)$results->id);
        self::assertSame('Report Type 1',$results->report_type);
    }

}