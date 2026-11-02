
<?php

require_once 'GradeCalculator.php';
require_once 'SimpleAverageStrategy.php';
require_once 'WeightedAverageStrategy.php';

// Student grades
$grades = [85, 90, 95];

// Create calculator using Simple Average
$calculator = new GradeCalculator(
    new SimpleAverageStrategy()
);

echo "<h2>Grade Calculation System</h2>";

// Calculate Simple Average
echo "Strategy: Simple Average<br>";
echo "Result: " .
    number_format($calculator->calculateGrade($grades), 2)
    . "<br><br>";

// Switch to Weighted Average
$calculator->setStrategy(
    new WeightedAverageStrategy()
);

// Calculate Weighted Average
echo "Strategy: Weighted Average<br>";
echo "Result: " .
    number_format($calculator->calculateGrade($grades), 2);
