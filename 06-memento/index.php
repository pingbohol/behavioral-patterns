<?php
class StudentProfileMemento {
    public function __construct(public readonly string $name, public readonly string $program, public readonly int $year, public readonly string $email) {}
}
class StudentProfile {
    public function __construct(public string $name, public string $program, public int $year, public string $email) {}
    public function save(): StudentProfileMemento { return new StudentProfileMemento($this->name, $this->program, $this->year, $this->email); }
    public function restore(StudentProfileMemento $memento): void {
        $this->name = $memento->name;
        $this->program = $memento->program;
        $this->year = $memento->year;
        $this->email = $memento->email;
    }
    public function show(): void {
        echo 'Name: ' . htmlspecialchars($this->name) . '<br>Program: ' . htmlspecialchars($this->program) . '<br>Year: ' . $this->year . '<br>Email: ' . htmlspecialchars($this->email) . '<br>';
    }
}
class ProfileHistory {
    private array $snapshots = [];
    public function backup(StudentProfile $profile): void { $this->snapshots[] = $profile->save(); }
    public function undo(StudentProfile $profile): void {
        if (!$this->snapshots) { echo 'No saved profile.<br>'; return; }
        $profile->restore(array_pop($this->snapshots));
    }
}
$profile = new StudentProfile('Juan Dela Cruz', 'BSIT', 3, 'juan@example.com');
$history = new ProfileHistory();
echo '<h2>Memento Pattern</h2>Original Profile:<br>';
$profile->show();
$history->backup($profile);
$profile->program = 'BSCS'; $profile->year = 4;
echo '<br>Current Profile:<br>'; $profile->show();
echo '<br>Undo...<br>'; $history->undo($profile);
echo 'Restored Profile:<br>'; $profile->show();
