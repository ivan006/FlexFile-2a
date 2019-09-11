<?php

class LowestNumberFinder {

    public function getLowest(string $numbers): string {

        // todo
        $result = null;
        $numbers = str_replace(' ', '', $numbers);
        $numbers = explode(',', $numbers);
        // $numbers = array_map('intval', $numbers);
        // sort($numbers);
        if (1==1) {
          // code...
          $numbersAsString = json_encode($numbers, JSON_PRETTY_PRINT);
          $numbersAsString = '<pre>'.$numbersAsString.'</pre>';
          $result .= $numbersAsString.'<br>';
        }


        $lowestNumber = min($numbers);
        $highestNumber = max($numbers);

        $result .= 'lowerst number: '.$lowestNumber.'<br>';
        $result .= 'highest number: '.$highestNumber.'<br>';

        $fullRange = range($lowestNumber,$highestNumber);
        if (1==1) {
          // code...
          $rangeAsString = json_encode($fullRange, JSON_PRETTY_PRINT);
          $rangeAsString = '<pre>'.$rangeAsString.'</pre>';
          $result .= $rangeAsString.'<br>';
        }

        $rangeDif = array_diff($fullRange,$numbers);

        if (1==1) {
          // code...
          $rangeDifAsString = json_encode($rangeDif, JSON_PRETTY_PRINT);
          $rangeDifAsString = '<pre>'.$rangeDifAsString.'</pre>';
          $result .= $rangeDifAsString.'<br>';
        }

        $lowestMissing = array_filter($rangeDif, function ($x) { return $x > 0; });


        if (1==1) {
          // code...
          $lowestMissingAsString = json_encode($lowestMissing, JSON_PRETTY_PRINT);
          $lowestMissingAsString = '<pre>'.$lowestMissingAsString.'</pre>';
          $result .= $lowestMissingAsString.'<br>';
        }

        $lowestMissing = min($lowestMissing);


        if (1==1) {
          // code...
          $result .= 'lowest missing: '.$lowestMissing.'<br>';
        }


        return $result;
    }


}
