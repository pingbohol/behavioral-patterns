
<?php

require_once 'StudentCollection.php';

// Create student collection
$students = new StudentCollection();

// Add student records
$students->add(new Student("2026-001", "Juan"));
$students->add(new Student("2026-002", "Maria"));
$students->add(new Student("2026-003", "Pedro"));

// Display student list
echo "<h2>Student List</h2>";

// Iterator Pattern using foreach
foreach ($students as $student) {
    echo $student->getId() . " - " .
         $student->getName() . "<br>";
}
