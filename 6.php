<?php
error_reporting(512);

// Puzzle input

$exampleData = [3,4,3,1,2];
$mainData = [5,1,4,1,5,1,1,5,4,4,4,4,5,1,2,2,1,3,4,1,1,5,1,5,2,2,2,2,1,4,2,4,3,3,3,3,1,1,1,4,3,4,3,1,2,1,5,1,1,4,3,3,1,5,3,4,1,1,3,5,2,4,1,5,3,3,5,4,2,2,3,2,1,1,4,1,2,4,4,2,1,4,3,3,4,4,5,3,4,5,1,1,3,2,5,1,5,1,1,5,2,1,1,4,3,2,5,2,1,1,4,1,5,5,3,4,1,5,4,5,3,1,1,1,4,5,3,1,1,1,5,3,3,5,1,4,1,1,3,2,4,1,3,1,4,5,5,1,4,4,4,2,2,5,5,5,5,5,1,2,3,1,1,2,2,2,2,4,4,1,5,4,5,2,1,2,5,4,4,3,2,1,5,1,4,5,1,4,3,4,1,3,1,5,5,3,1,1,5,1,1,1,2,1,2,2,1,4,3,2,4,4,4,3,1,1,1,5,5,5,3,2,5,2,1,1,5,4,1,2,1,1,1,1,1,2,1,1,4,2,1,3,4,2,3,1,2,2,3,3,4,3,5,4,1,3,1,1,1,2,5,2,4,5,2,3,3,2,1,2,1,1,2,5,3,1,5,2,2,5,1,3,3,2,5,1,3,1,1,3,1,1,2,2,2,3,1,1,4,2];

$data = $mainData;
$days = 80;

// Part 1

while ($days > 0) {
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i] === 0) {
            $data[$i] = 6;
            $data[] = 9;
        } else {
            $data[$i] -= 1;
        }
    }
    $days--;
}
echo count($data);

echo PHP_EOL;

// Part 2

$fishCount = [];
foreach (array_count_values($data) as $value => $count) {
    $fishCount[$value] = $count;
}

function makeNewFish($fishCount): array
{
    $newFishCount = [];
    for ($i = 1; $i < 9; $i++) {
        $newFishCount[$i-1] = $fishCount[$i];
    }
    $newFishCount[8] = $fishCount[0];
    $newFishCount[6] = $newFishCount[6] + $fishCount[0];
    return $newFishCount;
}

foreach (range(1, $days) as $day) {
    $fishCount = makeNewFish($fishCount);
}

echo array_sum($fishCount);
