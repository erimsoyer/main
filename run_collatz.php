<?php
include 'class.php';

echo "<h2>Collatz Conjecture (3x + 1)</h2>";

$rangeStart = 10; // start value
$rangeEnd = 5000; // end value

$collatzProcessor = new Collatz(); 
$collatzProcessor->processRange($rangeStart, $rangeEnd);
$statistics = $collatzProcessor->getStatistics();

echo "<strong>Our range:</strong> $rangeStart to $rangeEnd <br><br>";

if ($statistics) {
    echo "<strong>Statistics:</strong><br>";
    echo "Num with min iterations: " . $statistics['minIterations']['number'] . 
         " (" . $statistics['minIterations']['iterations'] . " steps)<br>";
    echo "Num with max iterations: " . $statistics['maxIterations']['number'] . 
         " (" . $statistics['maxIterations']['iterations'] . " steps)<br>";
    echo "Num with peak highest value: " . $statistics['maxPeakValue']['number'] . 
         " (Peak value: " . $statistics['maxPeakValue']['peakValue'] . ")<br>";
} else {
    echo "No statistics available. Please ensure you have processed a valid range.";
}
?>
