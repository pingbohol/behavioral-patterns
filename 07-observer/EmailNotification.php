
<?php

require_once 'Observer.php';

class EmailNotification implements Observer {

    public function update(float $grade): void {
        echo "Email Notification:<br>";
        echo "Your grade has been updated to: " . $grade . "<br><br>";
    }
}
