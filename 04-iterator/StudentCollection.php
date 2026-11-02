
<?php

require_once 'Student.php';

class StudentCollection implements IteratorAggregate {
    private array $students = [];

    public function add(Student $student): void {
        $this->students[] = $student;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->students);
    }
}
