<?php

namespace Directions\Instruction;

class TurnInstruction implements InstructionInterface
{
    protected $angle;

    public function __construct(float $angle)
    {
        $this->angle = $angle;
    }

    /**
     * @return float
     */
    public function getAngle(): float
    {
        return $this->angle;
    }
}