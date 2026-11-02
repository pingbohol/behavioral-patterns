
<?php

require_once 'Report.php';

class EnrollmentReport extends Report {

    protected function getTitle(): string {
        return "ENROLLMENT REPORT";
    }

    protected function retrieveData(): array {
        return [
            "Student ID" => "2026-001",
            "Name" => "Juan Dela Cruz",
            "Program" => "BSIT",
            "Year Level" => "4",
            "Status" => "Enrolled"
        ];
    }

    protected function formatData(array $data): void {
        foreach ($data as $label => $value) {
            echo $label . ": " . $value . "<br>";
        }
    }
}
