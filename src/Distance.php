<?php

namespace Directions;


class Distance
{
    /**
     * @param Point $point1
     * @param Point $point2
     *
     * @return float
     */
    public static function betweenPoints(Point $point1, Point $point2)
    {
        $distance = sqrt(
            pow($point2->getY() - $point1->getY(), 2) + pow($point2->getX() - $point1->getX(), 2)
        );

        return $distance;
    }
}