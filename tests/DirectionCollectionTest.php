<?php

namespace Directions\Tests;


use PHPUnit\Framework\TestCase;

class DirectionCollectionTest extends TestCase
{
    /**
     * 87.342 34.30 start 0 walk 10.0
     * 2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
     * 58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
     *
     * result
     * 97.1547 40.2334 7.63097
     */
    public function testResults()
    {
        $directionCollection = new \Directions\DirectionCollection();
        $direction1 = new \Directions\Direction(new \Directions\Point(87.342, 34.30), 0);
        $direction1->addInstruction(new \Directions\Instruction\WalkInstruction(10));

        $direction2 = new \Directions\Direction(new \Directions\Point(2.6762, 75.2811), -45.0);
        $direction2
            ->addInstruction(new \Directions\Instruction\WalkInstruction(40))
            ->addInstruction(new \Directions\Instruction\TurnInstruction(40.0))
            ->addInstruction(new \Directions\Instruction\WalkInstruction(60))
        ;

        $direction3 = new \Directions\Direction(new \Directions\Point(58.518, 93.508), 270);
        $direction3
            ->addInstruction(new \Directions\Instruction\WalkInstruction(50))
            ->addInstruction(new \Directions\Instruction\TurnInstruction(90))
            ->addInstruction(new \Directions\Instruction\WalkInstruction(40))
            ->addInstruction(new \Directions\Instruction\TurnInstruction(13))
            ->addInstruction(new \Directions\Instruction\WalkInstruction(5))
        ;

        $directionCollection
            ->addDirection($direction1)
            ->addDirection($direction2)
            ->addDirection($direction3)
        ;

        $this->assertEquals(
            sprintf(
                '%.4f %01.4f %01.5f',
                $directionCollection->getAveragePoint()->getX(),
                $directionCollection->getAveragePoint()->getY(),
                $directionCollection->getDistanceWorstAverage()
            ),
            '97.1547 40.2334 7.63097'
        );
    }
}