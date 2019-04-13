<?php

namespace Directions\Instruction;

class WalkInstruction implements InstructionInterface
{
    /**
     * @var float
     */
    protected $units;

    public function __construct(float $units)
    {
        $this->units = $units;
    }

    /**
     * @return float
     */
    public function getUnits(): float
    {
        return $this->units;
    }
}