<?php
include 'collatz_functions.php';  // Include the functions file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start = intval($_POST['start']);
    $end = intval($_POST['end']);
    
    if ($start < 1 || $end < 1 || $start > $end) {
        echo "Invalid range!";
        exit;
    }
    
    // Get results from the collatz_range function
    $statistics = collatz_range($start, $end);
    
    // Output the statistics
    echo "<h2>Collatz Conjecture Results</h2>";
    echo "<strong>Range:</strong> $start to $end <br><br>";
    
    echo "<strong>Numbers with max iterations:</strong><br>";
    echo "Number: " . $statistics['maxIterations']['number'] . 
         " with " . $statistics['maxIterations']['iterations'] . " iterations.<br><br>";
    
    echo "<strong>Numbers with min iterations:</strong><br>";
    echo "Number: " . $statistics['minIterations']['number'] . 
         " with " . $statistics['minIterations']['iterations'] . " iterations.<br><br>";
    
    echo "<strong>Number with the highest value:</strong><br>";
    echo "Number: " . $statistics['maxValue']['number'] . 
         " with a peak value of " . $statistics['maxValue']['maxValue'] . ".<br><br>";
    
    echo "<strong>Collatz Sequences:</strong><br>";
    foreach ($statistics['results'] as $num => $result) {
        echo "Number: $num, Iterations: " . $result['iterations'] . ", Max Value: " . $result['maxValue'] . "<br>";
        echo "Sequence: " . implode(" -> ", $result['sequence']) . "<br><br>";
    }
} else {
    // Display the form to the user
    echo '
    <h2>Collatz Conjecture (3x + 1) - Find Results</h2>
    <form method="POST">
        <label for="start">Start number:</label>
        <input type="number" name="start" id="start" required><br><br>
        
        <label for="end">End number:</label>
        <input type="number" name="end" id="end" required><br><br>
        
        <input type="submit" value="Submit">
    </form>';
}
?>
