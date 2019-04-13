<?php

namespace Directions;

use Directions\Instruction\InstructionInterface;
use Directions\Instruction\TurnInstruction;
use Directions\Instruction\WalkInstruction;

class Direction
{
    /**
     * @var Point
     */
    protected $startPoint;

    /**
     * @var float
     */
    protected $startAngle;

    /**
     * @var InstructionInterface[]
     */
    protected $instructions = [];

    /**
     * Direction constructor.
     * @param Point $startPoint
     * @param float $startAngle
     */
    public function __construct(Point $startPoint, float $startAngle)
    {
        $this->startPoint = $startPoint;
        $this->startAngle = $startAngle;
    }

    /**
     * @param InstructionInterface $instruction
     *
     * @return $this
     */
    public function addInstruction(InstructionInterface $instruction)
    {
        $this->instructions[] = $instruction;

        return $this;
    }

    /**
     * @return Point
     */
    public function getEndPoint()
    {
        $currentAngle = $this->startAngle;
        $currentPoint = clone $this->startPoint;

        foreach ($this->instructions as $instruction) {
            //@todo refactor this switch
            switch(true) {
                case $instruction instanceof WalkInstruction:
                    $x = $currentPoint->getX() + $instruction->getUnits() * cos(deg2rad($currentAngle));
                    $y = $currentPoint->getY() + $instruction->getUnits() * sin(deg2rad($currentAngle));
                    $currentPoint->setX($x)->setY($y);
                    break;
                case $instruction instanceof TurnInstruction:
                    $currentAngle += $instruction->getAngle();
                    break;
            }
        }

        return $currentPoint;
    }

    /**
     * @return Point
     */
    public function getStartPoint(): Point
    {
        return $this->startPoint;
    }
}