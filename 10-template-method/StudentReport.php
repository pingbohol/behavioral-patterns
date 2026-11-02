
<?php

require_once 'Report.php';

class StudentReport extends Report {

    protected function getTitle(): string {
        return "STUDENT REPORT";
    }

    protected function retrieveData(): array {
        return [
            "Student ID" => "2026-001",
            "Name" => "Juan Dela Cruz",
            "Program" => "BSIT"
        ];
    }

    protected function formatData(array $data): void {
        foreach ($data as $label => $value) {
            echo $label . ": " . $value . "<br>";
        }
    }
}
