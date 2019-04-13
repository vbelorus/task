<?php

namespace Directions;


class Point
{
    /** @var float */
    protected $x;

    /** @var float */
    protected $y;

    /**
     * Point constructor.
     *
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $x
     *
     * @return Point
     */
    public function setX(float $x): Point
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @param float $y
     *
     * @return Point
     */
    public function setY(float $y): Point
    {
        $this->y = $y;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%d %d",
            $this->x,
            $this->y
        );
    }
}