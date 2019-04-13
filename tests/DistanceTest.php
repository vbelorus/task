<?php

namespace Directions\Tests;

use Directions\Distance;
use Directions\Point;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    public function testDistanceBetweenPoints()
    {
        $distance = Distance::betweenPoints(new Point(0, 0), new Point(10, 0));
        $this->assertTrue($distance == 10);

        $distance = Distance::betweenPoints(new Point(0, 0), new Point(-10, 0));
        $this->assertTrue($distance == 10);

        $distance = Distance::betweenPoints(new Point(0, 0), new Point(1, 1));
        $this->assertTrue($distance == sqrt(2));
    }
}