<?php
interface Mediator { public function send(string $message, Student $sender): void; public function addStudent(Student $student): void; }
class ChatMediator implements Mediator {
    private array $students = [];
    public function addStudent(Student $student): void { $this->students[] = $student; }
    public function send(string $message, Student $sender): void {
        foreach ($this->students as $student) {
            if ($student !== $sender) $student->receive($sender->getName(), $message);
        }
    }
}
class Student {
    public function __construct(private string $name, private Mediator $mediator) {}
    public function getName(): string { return $this->name; }
    public function send(string $message): void {
        echo htmlspecialchars($this->name . ': ' . $message) . '<br><br>';
        $this->mediator->send($message, $this);
    }
    public function receive(string $from, string $message): void {
        echo htmlspecialchars($this->name) . ' receives:<br>' . htmlspecialchars($from . ': ' . $message) . '<br><br>';
    }
}
$chat = new ChatMediator();
$juan = new Student('Juan', $chat);
$maria = new Student('Maria', $chat);
$pedro = new Student('Pedro', $chat);
foreach ([$juan, $maria, $pedro] as $student) $chat->addStudent($student);
echo '<h2>Mediator Pattern</h2>';
$juan->send('Hello everyone!');
