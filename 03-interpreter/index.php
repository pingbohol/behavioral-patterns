<?php
class StudentContext {
    public function __construct(public string $program, public int $year) {}
}
interface Expression { public function interpret(StudentContext $context): bool; }
class TerminalExpression implements Expression {
    public function __construct(private string $field, private string|int $value) {}
    public function interpret(StudentContext $context): bool {
        return match (strtoupper($this->field)) {
            'PROGRAM' => $context->program === $this->value,
            'YEAR' => $context->year === (int)$this->value,
            default => false
        };
    }
}
class AndExpression implements Expression {
    public function __construct(private Expression $left, private Expression $right) {}
    public function interpret(StudentContext $context): bool { return $this->left->interpret($context) && $this->right->interpret($context); }
}
class OrExpression implements Expression {
    public function __construct(private Expression $left, private Expression $right) {}
    public function interpret(StudentContext $context): bool { return $this->left->interpret($context) || $this->right->interpret($context); }
}
$student = new StudentContext('BSIT', 4);
$expression = new AndExpression(new TerminalExpression('PROGRAM', 'BSIT'), new TerminalExpression('YEAR', 4));
$orExpression = new OrExpression(new TerminalExpression('PROGRAM', 'BSIT'), new TerminalExpression('PROGRAM', 'BSCS'));
echo '<h2>Interpreter Pattern</h2>';
echo 'Expression: PROGRAM = "BSIT" AND YEAR = 4<br>Result: ' . ($expression->interpret($student) ? 'TRUE' : 'FALSE') . '<br><br>';
echo 'Expression: PROGRAM = "BSIT" OR PROGRAM = "BSCS"<br>Result: ' . ($orExpression->interpret($student) ? 'TRUE' : 'FALSE');
