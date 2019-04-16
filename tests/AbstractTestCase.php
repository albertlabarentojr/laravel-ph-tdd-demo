<?php
declare(strict_types=1);

namespace Tests\LaraMarketing;

use Closure;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    /** @var \Illuminate\Contracts\Container\Container */
    protected $app;

    /**
     * Mock with closure.
     *
     * @param string $contract
     * @param \Closure $setExpectations
     *
     * @return \Mockery\MockInterface
     */
    protected function mock(string $contract, ?Closure $setExpectations = null): MockInterface
    {
        $mock = Mockery::mock($contract);

        if ($setExpectations === null) {
            return $mock;
        }

        $setExpectations($mock);

        return $mock;
    }

    protected function setUp()
    {
        parent::setUp();

        $this->app = require __DIR__ . '/../src/app.php';
    }
}
