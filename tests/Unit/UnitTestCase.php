<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\Test\ClockSensitiveTrait;

abstract class UnitTestCase extends TestCase
{
    use ClockSensitiveTrait;
}
