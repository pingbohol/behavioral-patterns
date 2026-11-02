
<?php

require_once 'GradeStrategy.php';

class GradeCalculator {
    private GradeStrategy $strategy;

    // Set the grading strategy
    public function __construct(GradeStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // Change the grading strategy
    public function setStrategy(GradeStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    // Calculate grades using the selected strategy
    public function calculateGrade(array $grades): float {
        return $this->strategy->calculate($grades);
    }
}
