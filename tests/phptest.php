<?php
class Test {
	
	public $a = 2;
	
	function __construct() {
	$a = $this->a;
	}

	public function Test0($b) {
		$x = $this->a;
		$x = $x * $b + $b;
		return $x;
	}
}	


$Test = new Test;
$value1 = $Test->Test0(2);

echo $value1;