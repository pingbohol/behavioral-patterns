<?php
interface Command { public function execute(): void; public function undo(): void; }
class StudentSystem {
    public bool $enrolled = false;
    public bool $subjectDropped = false;
    public function enroll(): void { $this->enrolled = true; echo 'Student successfully enrolled.<br>'; }
    public function undoEnroll(): void { $this->enrolled = false; echo 'Enrollment undone.<br>'; }
    public function dropSubject(): void { $this->subjectDropped = true; echo 'Subject successfully dropped.<br>'; }
    public function undoDrop(): void { $this->subjectDropped = false; echo 'Subject drop undone.<br>'; }
    public function printRegistration(): void { echo 'Registration printed.<br>'; }
    public function logout(): void { echo 'Student logged out.<br>'; }
}
class EnrollCommand implements Command {
    public function __construct(private StudentSystem $system) {}
    public function execute(): void { $this->system->enroll(); }
    public function undo(): void { $this->system->undoEnroll(); }
}
class DropSubjectCommand implements Command {
    public function __construct(private StudentSystem $system) {}
    public function execute(): void { $this->system->dropSubject(); }
    public function undo(): void { $this->system->undoDrop(); }
}
class PrintRegistrationCommand implements Command {
    public function __construct(private StudentSystem $system) {}
    public function execute(): void { $this->system->printRegistration(); }
    public function undo(): void { echo 'Print cannot be undone.<br>'; }
}
class LogoutCommand implements Command {
    public function __construct(private StudentSystem $system) {}
    public function execute(): void { $this->system->logout(); }
    public function undo(): void { echo 'Logout cannot be undone.<br>'; }
}
class CommandInvoker {
    private array $history = [];
    public function run(string $label, Command $command): void {
        echo 'Executing: ' . htmlspecialchars($label) . '<br>';
        $command->execute();
        $this->history[] = $command;
    }
    public function undo(): void {
        if (!$this->history) { echo 'Nothing to undo.<br>'; return; }
        echo 'Undo: '; array_pop($this->history)->undo();
    }
}
$system = new StudentSystem();
$invoker = new CommandInvoker();
echo '<h2>Command Pattern</h2>';
$invoker->run('Enroll Student', new EnrollCommand($system));
$invoker->run('Drop Subject', new DropSubjectCommand($system));
$invoker->undo();
$invoker->run('Print Registration', new PrintRegistrationCommand($system));
$invoker->run('Logout', new LogoutCommand($system));
