
<?php

require_once 'GradeStrategy.php';

class WeightedAverageStrategy implements GradeStrategy {

    public function calculate(array $grades): float {
        if (count($grades) === 0) {
            return 0.0;
        }

        // Assign weights to each grade
        $weights = [0.20, 0.30, 0.50];

        if (count($grades) !== count($weights)) {
            throw new InvalidArgumentException(
                "Exactly three grades are required."
            );
        }

        $weightedSum = 0;

        foreach ($grades as $index => $grade) {
            $weightedSum += $grade * $weights[$index];
        }

        return $weightedSum;
    }
}
