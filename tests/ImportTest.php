<?php

namespace Tests\Thamaraiselvam\MysqlImport;

use Exception;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;
use stdClass;
use Thamaraiselvam\MysqlImport\Import;

class ImportTest extends PHPUnit_Framework_TestCase
{

    public function testExceptionOnConnection()
    {
        // Creating mock for mysqli which will return an errno != 0
        $dbMock = new stdClass();
        $dbMock->connect_errno = 1;

        // Now we reflect a connect method for later invoke
        // This is the only way to run protected method
        // from outside the Import class
        $connectMethod = new ReflectionMethod(Import::class, 'connect');
        $connectMethod->setAccessible(true);

        $mock = $this->getImportMock($dbMock);

        // Setting expected exception and invoke connect method
        $this->expectException(Exception::class);
        $this->expectExceptionMessageRegExp('/^Failed to connect to MySQL: /');
        $connectMethod->invoke($mock);
    }

    public function testQuery()
    {
        // Creating mock for mysqli with
        // query method mocked
        $dbMock = $this->createPartialMock(
            stdClass::class,
            array('query')
        );

        // We expect query method to be called twice
        // we don't care about the input arguments
        // but we expect return true on first call
        // and false on second call
        $dbMock->expects($this->exactly(2))
               ->method('query')
               ->with($this->anything())
               ->willReturnOnConsecutiveCalls(true, false);

        $mock = $this->getImportMock($dbMock);

        // Running connect method to init db property
        $connectMethod = new ReflectionMethod(Import::class, 'connect');
        $connectMethod->setAccessible(true);
        $connectMethod->invoke($mock);

        $queryMethod = new ReflectionMethod(Import::class, 'query');
        $queryMethod->setAccessible(true);

        // First query will return true, so we expect null on return
        $this->assertNull($queryMethod->invoke($mock, 'First run'));

        // Second query will return false, exception expected
        $this->expectException(Exception::class);
        $this->expectExceptionMessageRegExp('/^Error with query: /');
        $queryMethod->invoke($mock, 'Second run');
    }

    protected function getImportMock($dbMock)
    {
        // Creating Import mock and defining
        // createconnection method for later replace
        $mock = $this->createPartialMock(
            Import::class,
            array('createconnection')
        );

        // Replacing createconnection method and
        // defining a return value when called
        $mock->expects($this->once())
             ->method('createconnection')
             ->willReturn($dbMock);

        return $mock;
    }
}
