<?php
interface EnrollmentState { public function name(): string; public function enroll(Student $student): void; }
class Student {
    public function __construct(private EnrollmentState $state) {}
    public function setState(EnrollmentState $state): void { $this->state = $state; }
    public function status(): string { return $this->state->name(); }
    public function enroll(): void { $this->state->enroll($this); }
}
class ApplicantState implements EnrollmentState {
    public function name(): string { return 'Applicant'; }
    public function enroll(Student $student): void { echo 'Student must complete pre-assessment first.<br>'; }
}
class PreAssessedState implements EnrollmentState {
    public function name(): string { return 'Pre-Assessed'; }
    public function enroll(Student $student): void { $student->setState(new EnrolledState()); echo 'Student successfully enrolled.<br>'; }
}
class EnrolledState implements EnrollmentState {
    public function name(): string { return 'Enrolled'; }
    public function enroll(Student $student): void { echo 'Student is already enrolled.<br>'; }
}
class DroppedState implements EnrollmentState {
    public function name(): string { return 'Dropped'; }
    public function enroll(Student $student): void { echo 'Dropped student must contact the Registrar.<br>'; }
}
class GraduatedState implements EnrollmentState {
    public function name(): string { return 'Graduated'; }
    public function enroll(Student $student): void { echo 'Student has already graduated.<br>'; }
}
$student = new Student(new ApplicantState());
echo '<h2>State Pattern</h2>Current State: ' . $student->status() . '<br>Action: Enroll<br>Result: ';
$student->enroll();
$student->setState(new PreAssessedState());
echo '<br>Current State: ' . $student->status() . '<br>Action: Enroll<br>Result: ';
$student->enroll();
echo 'New State: ' . $student->status() . '<br>';
