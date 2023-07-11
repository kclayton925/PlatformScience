<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class DriverTest extends TestCase
{
    public function testDriverCreation(): void
    {
        $this->assertInstanceOf(
            \PlatformScience\Driver::class,
            new \PlatformScience\Driver('Jimmy Bean')
        );
    }

    public function
}
