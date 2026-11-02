
<?php

require_once 'Observer.php';

class ParentNotification implements Observer {

    public function update(float $grade): void {
        echo "Parent Notification:<br>";
        echo "Student grade has been posted: " . $grade . "<br><br>";
    }
}
