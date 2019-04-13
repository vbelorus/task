<?php

namespace Directions;

class DirectionCollection
{
    /**
     * @var Direction[]
     */
    protected $directions = [];

    /**
     * @param Direction $direction
     *
     * @return $this
     */
    public function addDirection(Direction $direction)
    {
        $this->directions[] = $direction;
        return $this;
    }

    /**
     * @return Point
     */
    public function getAveragePoint()
    {
        $sumX = 0;
        $sumY = 0;

        foreach ($this->directions as $direction) {
            $endPoint = $direction->getEndPoint();
            $sumX += $endPoint->getX();
            $sumY += $endPoint->getY();
        }

        $avgX = $sumX / count($this->directions);
        $avgY = $sumY / count($this->directions);

        return new Point($avgX, $avgY);
    }

    /**
     * @return float
     */
    public function getDistanceWorstAverage()
    {
        $avgPoint = $this->getAveragePoint();
        $distance = 0;

        foreach ($this->directions as $direction) {
            $newDistance = Distance::betweenPoints($avgPoint, $direction->getEndPoint());
            if ($distance < $newDistance) {
                $distance = $newDistance;
            }
        }

        return $distance;
    }
}