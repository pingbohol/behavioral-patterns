<?php
interface Handler { public function setNext(Handler $next): Handler; public function handle(StudentRequest $request): void; }
class StudentRequest { public function __construct(public string $type) {} }
abstract class BaseHandler implements Handler {
    protected ?Handler $next = null;
    public function setNext(Handler $next): Handler { $this->next = $next; return $next; }
    protected function forward(StudentRequest $r, string $office): void {
        echo "$office: Cannot process request.<br>";
        if ($this->next) $this->next->handle($r);
        else echo "No office can process this request.<br>";
    }
}
class StudentAffairsHandler extends BaseHandler {
    public function handle(StudentRequest $r): void {
        if ($r->type === 'Good Moral Certificate') echo "Student Affairs: Processing {$r->type}...<br>";
        else $this->forward($r, 'Student Affairs');
    }
}
class RegistrarHandler extends BaseHandler {
    public function handle(StudentRequest $r): void {
        if (in_array($r->type, ['Transcript of Records', 'Certificate of Enrollment'], true)) echo "Registrar: Processing {$r->type}...<br>";
        else $this->forward($r, 'Registrar');
    }
}
class FinanceHandler extends BaseHandler {
    public function handle(StudentRequest $r): void {
        if ($r->type === 'Payment Concern') echo "Finance: Processing {$r->type}...<br>";
        else $this->forward($r, 'Finance');
    }
}
class ICTHandler extends BaseHandler {
    public function handle(StudentRequest $r): void {
        if ($r->type === 'Student ID Concern') echo "ICT: Processing {$r->type}...<br>";
        else $this->forward($r, 'ICT');
    }
}
$affairs = new StudentAffairsHandler();
$registrar = new RegistrarHandler();
$finance = new FinanceHandler();
$ict = new ICTHandler();
$affairs->setNext($registrar)->setNext($finance)->setNext($ict);
$request = new StudentRequest('Transcript of Records');
echo '<h2>Chain of Responsibility</h2>Request: ' . htmlspecialchars($request->type) . '<br>';
$affairs->handle($request);
