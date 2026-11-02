
<?php

require_once 'Observer.php';

class GradeSystem {
    private array $observers = [];
    private float $grade;

    // Register an observer
    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    // Notify all observers
    public function notifyObservers(): void {
        foreach ($this->observers as $observer) {
            $observer->update($this->grade);
        }
    }

    // Update the student grade
    public function setGrade(float $grade): void {
        $this->grade = $grade;

        echo "Grade updated: " . $grade . "<br><br>";

        $this->notifyObservers();
    }
}
