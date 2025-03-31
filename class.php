<?php
class Collatz {
    protected int $rangeStart;
    protected int $rangeEnd;
    protected array $resultData = [];

    public function __construct(int $rangeStart = 1, int $rangeEnd = 100) {
        $this->rangeStart = $rangeStart;
        $this->rangeEnd = $rangeEnd;
    }

    public function processSingle(int $inputNumber): array {
        $currentValue = $inputNumber;
        $iterationCount = 0;
        $highestValue = $inputNumber;

        while ($currentValue !== 1) {
            if ($currentValue % 2 === 0) {
                $currentValue /= 2;
            } else {
                $currentValue = 3 * $currentValue + 1;
            }

            if ($currentValue > $highestValue) {
                $highestValue = $currentValue;
            }

            $iterationCount++;
        }

        return [
            'initial' => $inputNumber,
            'iterations' => $iterationCount,
            'peakValue' => $highestValue
        ];
    }

    public function processRange(): void {
        $this->resultData = [];

        for ($index = $this->rangeStart; $index <= $this->rangeEnd; $index++) {
            $this->resultData[$index] = $this->processSingle($index);
        }
    }

    public function getStatistics(): ?array {
        if (empty($this->resultData)) {
            return null;
        }

        $maxIterations = null;
        $minIterations = null;
        $maxPeakValue = null;

        foreach ($this->resultData as $key => $record) {
            if (!$maxIterations || $record['iterations'] > $maxIterations['iterations']) {
                $maxIterations = ['number' => $key, 'iterations' => $record['iterations']];
            }

            if (!$minIterations || $record['iterations'] < $minIterations['iterations']) {
                $minIterations = ['number' => $key, 'iterations' => $record['iterations']];
            }

            if (!$maxPeakValue || $record['peakValue'] > $maxPeakValue['peakValue']) {
                $maxPeakValue = ['number' => $key, 'peakValue' => $record['peakValue']];
            }
        }

        return [
            'maxIterations' => $maxIterations,
            'minIterations' => $minIterations,
            'maxPeakValue' => $maxPeakValue
        ];
    }
}
?>
