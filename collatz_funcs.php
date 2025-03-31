<?php
require_once 'C:/xampp/htdocs/previoustask.php'; 
function collatzRange($start, $end) {
    $results = [];

    for ($i = $start; $i <= $end; $i++) {
        $sequence = collatz($i); 
        $max_value = max($sequence);  
        $iterations = count($sequence) - 1;

        $results[$i] = [
            'max_value' => $max_value,
            'iterations' => $iterations
        ];
    }

    return $results;
}
?>
