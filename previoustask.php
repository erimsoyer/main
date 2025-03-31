<?php
function collatz_sequence($number) {
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

function collatz_range($start, $end) {
    $results = [];
    
    for ($i = $start; $i <= $end; $i++) {
        $data = collatz_sequence($i);
        $results[$i] = $data;
    }
    
    return $results;
}
?>
