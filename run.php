<?php
require 'class.php';

class CollatzHistogram extends Collatz {
    private const DEFAULT_MIN_RANGE = 1;
    private const DEFAULT_MAX_RANGE = 100;

    public function __construct(int $rangeStart = self::DEFAULT_MIN_RANGE, int $rangeEnd = self::DEFAULT_MAX_RANGE) {
        parent::__construct($rangeStart, $rangeEnd);
    }

    public function prepareChartData(): array {
        $this->processRange();

        $chartData = [];
        foreach ($this->resultData as $number => $record) {
            $chartData[] = [
                'x' => $number,
                'y' => $record['iterations'],
                'label' => "Number: {$number}, Iterations: {$record['iterations']}, Max: {$record['peakValue']}"
            ];
        }

        return $chartData;
    }
}

$chartData = [];
try {
    $collatzHistogram = new CollatzHistogram(1, 50);
    $chartData = $collatzHistogram->prepareChartData();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1",
        title: {
            text: "Collatz Conjecture Iterations"
        },
        axisX: {
            title: "Number",
            interval: 1
        },
        axisY: {
            title: "Count of Iterations",
            includeZero: true
        },
        data: [{
            type: "column",
            toolTipContent: "{label}",
            indexLabel: "{x}",
            indexLabelPlacement: "outside",
            dataPoints: <?php echo json_encode($chartData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
