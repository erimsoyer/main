<?php

// Function to calculate Collatz sequence for a single number
function collatz_single($number) {
    $sequence = [];
    $maxValue = $number;
    $iterations = 0;

    while ($number != 1) {
        $sequence[] = $number;
        if ($number % 2 == 0) {
            $number /= 2;
        } else {
            $number = 3 * $number + 1;
        }
        if ($number > $maxValue) {
            $maxValue = $number;
        }
        $iterations++;
    }

    $sequence[] = 1;  // Add the final 1 to the sequence
    return [
        'sequence' => $sequence,
        'maxValue' => $maxValue,
        'iterations' => $iterations
    ];
}

// Function to calculate Collatz for a range of numbers
function collatz_range($start, $end) {
    $results = [];
    $maxIterations = -1;
    $minIterations = PHP_INT_MAX;
    $maxIterationNumber = 0;
    $minIterationNumber = 0;
    $maxValueNumber = 0;
    $maxValue = -1;

    for ($i = $start; $i <= $end; $i++) {
        $result = collatz_single($i);
        $results[$i] = $result;
        
        // Find number with max and min iterations
        if ($result['iterations'] > $maxIterations) {
            $maxIterations = $result['iterations'];
            $maxIterationNumber = $i;
        }
        if ($result['iterations'] < $minIterations) {
            $minIterations = $result['iterations'];
            $minIterationNumber = $i;
        }

        // Find number with max value
        if ($result['maxValue'] > $maxValue) {
            $maxValue = $result['maxValue'];
            $maxValueNumber = $i;
        }
    }

    return [
        'results' => $results,
        'maxIterations' => [
            'number' => $maxIterationNumber,
            'iterations' => $maxIterations
        ],
        'minIterations' => [
            'number' => $minIterationNumber,
            'iterations' => $minIterations
        ],
        'maxValue' => [
            'number' => $maxValueNumber,
            'maxValue' => $maxValue
        ]
    ];
}

?>
