
<?php

require_once 'Report.php';

class GradeReport extends Report {

    protected function getTitle(): string {
        return "GRADE REPORT";
    }

    protected function retrieveData(): array {
        return [
            "Student ID" => "2026-001",
            "Name" => "Juan Dela Cruz",
            "Subject" => "Programming",
            "Grade" => "1.75"
        ];
    }

    protected function formatData(array $data): void {
        foreach ($data as $label => $value) {
            echo $label . ": " . $value . "<br>";
        }
    }
}
