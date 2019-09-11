<?php

class LowestNumberFinder {

    public function getLowest(string $numbers): string {

        // todo
        $range1 = $numbers;
        $range1 = str_replace(' ', '', $range1);
        $range1 = explode(',', $range1);
        $range2Lowest = min($range1)-1;
        $range2Highest = max($range1)+1;
        $range2 = range($range2Lowest,$range2Highest);
        $missing = array_diff($range2,$range1);
        $missing = array_filter($missing, function ($x) { return $x > 0; });
        $missingLowest = min($missing);

        return $missingLowest;
    }


}
