<?php 
function collatz($number) {
    if (!is_int($number) || $number < 1) {
        return "Please enter a positive integer.";
    }
    
    $sequence = [$number];
    
    while ($number > 1) {
        if ($number % 2 == 0) {
            $number = $number / 2;
        } else {
            $number = 3 * $number + 1;
        }
        $sequence[] = $number;
    }
    
    return $sequence;
}

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

$results = [];
$error = "";
$start = $end = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = intval($_POST["start"]);
    $end = intval($_POST["end"]);

    if ($start < 1 || $end < 1 || $start > $end) {
        $error = "Please enter valid numbers (start < end, both > 0).";
    } else {
        $results = collatzRange($start, $end);
        
        $max_iterations = 0;
        $min_iterations = PHP_INT_MAX;
        $max_value = 0;
        $num_max_iterations = $num_min_iterations = $num_max_value = 0;
        
        foreach ($results as $num => $data) {
            if ($data['iterations'] > $max_iterations) {
                $max_iterations = $data['iterations'];
                $num_max_iterations = $num;
            }
            if ($data['iterations'] < $min_iterations) {
                $min_iterations = $data['iterations'];
                $num_min_iterations = $num;
            }
            if ($data['max_value'] > $max_value) {
                $max_value = $data['max_value'];
                $num_max_value = $num;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Collatz Calculator</title>
</head>
<body>
    <h2>Collatz Calculator</h2>
    <form method="post">
        <label for="start">Start Number:</label>
        <input type="number" name="start" value="<?php echo $start; ?>" required>
        <br>
        <label for="end">End Number:</label>
        <input type="number" name="end" value="<?php echo $end; ?>" required>
        <br>
        <input type="submit" value="Calculate">
    </form>

    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <?php if (!empty($results)) { ?>
        <h2>Results for numbers <?php echo $start; ?> to <?php echo $end; ?></h2>
        <p><strong>num with max iterations (<?php echo $max_iterations; ?>):</strong> <?php echo $num_max_iterations; ?></p>
        <p><strong>num with min iterations (<?php echo $min_iterations; ?>):</strong> <?php echo $num_min_iterations; ?></p>
        <p><strong>num with highest value (<?php echo $max_value; ?>):</strong> <?php echo $num_max_value; ?></p>
    <?php } ?>
</body>
</html>
