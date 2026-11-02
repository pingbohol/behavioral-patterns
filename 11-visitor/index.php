<?php
interface Visitor {
    public function visitStudent(Student $student): void;
    public function visitFaculty(Faculty $faculty): void;
    public function visitAlumni(Alumni $alumni): void;
}
interface Element { public function accept(Visitor $visitor): void; }
class Student implements Element {
    public function __construct(public string $name) {}
    public function accept(Visitor $visitor): void { $visitor->visitStudent($this); }
}
class Faculty implements Element {
    public function __construct(public string $name) {}
    public function accept(Visitor $visitor): void { $visitor->visitFaculty($this); }
}
class Alumni implements Element {
    public function __construct(public string $name) {}
    public function accept(Visitor $visitor): void { $visitor->visitAlumni($this); }
}
class CSVExportVisitor implements Visitor {
    public function visitStudent(Student $student): void { echo 'Student exported.<br>'; }
    public function visitFaculty(Faculty $faculty): void { echo 'Faculty exported.<br>'; }
    public function visitAlumni(Alumni $alumni): void { echo 'Alumni exported.<br>'; }
}
class ReportVisitor implements Visitor {
    public function visitStudent(Student $student): void { echo 'Student report: ' . htmlspecialchars($student->name) . '<br>'; }
    public function visitFaculty(Faculty $faculty): void { echo 'Faculty report: ' . htmlspecialchars($faculty->name) . '<br>'; }
    public function visitAlumni(Alumni $alumni): void { echo 'Alumni report: ' . htmlspecialchars($alumni->name) . '<br>'; }
}
class StatisticsVisitor implements Visitor {
    public int $count = 0;
    public function visitStudent(Student $student): void { $this->count++; }
    public function visitFaculty(Faculty $faculty): void { $this->count++; }
    public function visitAlumni(Alumni $alumni): void { $this->count++; }
}
class PDFReportVisitor implements Visitor {
    public function visitStudent(Student $student): void { echo 'Student PDF report prepared.<br>'; }
    public function visitFaculty(Faculty $faculty): void { echo 'Faculty PDF report prepared.<br>'; }
    public function visitAlumni(Alumni $alumni): void { echo 'Alumni PDF report prepared.<br>'; }
}
$records = [new Student('Juan'), new Faculty('Ms. Santos'), new Alumni('Pedro')];
echo '<h2>Visitor Pattern</h2>CSV Export Visitor<br>';
foreach ($records as $record) $record->accept(new CSVExportVisitor());
echo '<br>Report Visitor<br>';
foreach ($records as $record) $record->accept(new ReportVisitor());
$stats = new StatisticsVisitor();
foreach ($records as $record) $record->accept($stats);
echo '<br>Statistics Visitor<br>Total records: ' . $stats->count . '<br><br>PDF Report Visitor (demo only)<br>';
foreach ($records as $record) $record->accept(new PDFReportVisitor());
