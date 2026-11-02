
<?php

require_once 'GradeSystem.php';
require_once 'StudentPortal.php';
require_once 'EmailNotification.php';
require_once 'ParentNotification.php';

// Create Grade System
$gradeSystem = new GradeSystem();

// Register observers
$gradeSystem->attach(new StudentPortal());
$gradeSystem->attach(new EmailNotification());
$gradeSystem->attach(new ParentNotification());

// Update grade
$gradeSystem->setGrade(1.75);
