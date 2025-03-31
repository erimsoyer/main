<?php

class Collatz {
    private $startNumber;

    // Constructor to initialize the starting number
    public function __construct($startNumber) {
        $this->startNumber = $startNumber;
    }

    // Method to perform the Collatz sequence calculation
    public function collatz_sequence($number) {
        $sequence = [$number];
        $max_value = $number;
        $iterations = 0;

        while ($number > 1) {
            if ($number % 2 == 0) {
                $number /= 2;
            } else {
                $number = 3 * $number + 1;
            }
            $sequence[] = $number;
            $max_value = max($max_value, $number);
            $iterations++;
        }

        return [
            'sequence' => $sequence,
            'max_value' => $max_value,
            'iterations' => $iterations
        ];
    }

    // Method to perform calculations based on a given interval
    public function collatz_range($start, $end) {
        $results = [];

        for ($i = $start; $i <= $end; $i++) {
            $data = $this->collatz_sequence($i);
            $results[$i] = $data;
        }

        return $results;
    }

    // Method to generate statistics for the given range
    public function statistics($start, $end) {
        $results = $this->collatz_range($start, $end);

        $maxIterations = 0;
        $minIterations = PHP_INT_MAX;
        $maxValue = 0;
        $maxIterationsNumber = $minIterationsNumber = $maxValueNumber = 0;

        foreach ($results as $number => $data) {
            if ($data['iterations'] > $maxIterations) {
                $maxIterations = $data['iterations'];
                $maxIterationsNumber = $number;
            }
            if ($data['iterations'] < $minIterations) {
                $minIterations = $data['iterations'];
                $minIterationsNumber = $number;
            }
            if ($data['max_value'] > $maxValue) {
                $maxValue = $data['max_value'];
                $maxValueNumber = $number;
            }
        }

        return [
            'max_iterations' => ['number' => $maxIterationsNumber, 'iterations' => $maxIterations],
            'min_iterations' => ['number' => $minIterationsNumber, 'iterations' => $minIterations],
            'max_value' => ['number' => $maxValueNumber, 'value' => $maxValue]
        ];
    }
}
?>
