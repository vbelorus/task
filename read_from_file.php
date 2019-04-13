<?php

require_once __DIR__."/vendor/autoload.php";

$startDataRegex = '/^([-+]?[0-9]*\.?[0-9]+) ([-+]?[0-9]*\.?[0-9]+) start ([-+]?[0-9]*\.?[0-9]+) (.*)/i';
$instructionsRegex = '/walk [-+]?[0-9]*\.?[0-9]+|turn [-+]?[0-9]*\.?[0-9]+/i';
$handle = fopen(__DIR__ . DIRECTORY_SEPARATOR . "input.txt", "r");
/** @var \Directions\DirectionCollection[] $directionCollections */
$directionCollections = [];
$i = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $line = trim($line);
        if (preg_match('/^\d+$/', $line, $matches)) {
            $i++;
            if ($matches[0] == 0) {
                continue;
            }

            $directionCollections[$i] = new Directions\DirectionCollection();
        } else {
            if (preg_match_all($startDataRegex, $line, $directionMatches)) {
                $startX = $directionMatches[1][0];
                $startY = $directionMatches[2][0];
                $initialAngle = $directionMatches[3][0];

                $direction = new \Directions\Direction(new \Directions\Point((float)$startX, (float)$startY), (float)$initialAngle);
                if (preg_match_all($instructionsRegex, $directionMatches[4][0], $instructionsMatches)) {
                    foreach ($instructionsMatches[0] as $instructionsMatch) {
                        if (preg_match('/turn ([-+]?[0-9]*\.?[0-9]+)/i', $instructionsMatch, $instructionTurn)) {
                            $instruction = new \Directions\Instruction\TurnInstruction((float)$instructionTurn[1]);
                        }

                        if (preg_match('/walk ([-+]?[0-9]*\.?[0-9]+)/i', $instructionsMatch, $instructionWalk)) {
                            $instruction = new \Directions\Instruction\WalkInstruction((float)$instructionWalk[1]);
                        }

                        $direction->addInstruction($instruction);
                    }
                }
                $directionCollections[$i]->addDirection($direction);
            }
        }
    }

    fclose($handle);
}

foreach ($directionCollections as $directionCollection) {
    printf(
        '%.4f %01.4f %01.5f' . PHP_EOL,
        $directionCollection->getAveragePoint()->getX(),
        $directionCollection->getAveragePoint()->getY(),
        $directionCollection->getDistanceWorstAverage()
    );
}

