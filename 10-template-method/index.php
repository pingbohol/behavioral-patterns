
<?php

require_once 'StudentReport.php';
require_once 'GradeReport.php';
require_once 'EnrollmentReport.php';

// Generate Student Report
$studentReport = new StudentReport();
$studentReport->generateReport();

// Generate Grade Report
$gradeReport = new GradeReport();
$gradeReport->generateReport();

// Generate Enrollment Report
$enrollmentReport = new EnrollmentReport();
$enrollmentReport->generateReport();
