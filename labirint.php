<?php
interface IRobot {
	public function getSpeed();
	public function getPosition();
	public function getName();
	public function move();
}

class Labirint {
	private $robots = array();
	
	function enterRobot(IRobot $r) {
		$this->robots[]=$r;
	}

	function process() {
	 	
	 	foreach ($this->robots as $robot) {
	 		$robot->move();
	 	}

	 }
	
}

abstract class Robot implements IRobot {
	
	protected $position = 0;
	protected $name;

	public function __construct($name){
		$this->name = $name;
	}

	abstract public function getSpeed();

	public function getPosition() {
		return $this->position;
	}

	public function getName() {
		return $this->name;
	}
	public function move()
	{
		$this->position += $this->getSpeed();
	}

	public function __toString(){
		return sprintf("%s on %s position.", 
			$this->getName(), 
			$this->getPosition());
	}
}

class Strong_and_quick_Robot extends Robot  {	

	public function getSpeed(){
		return 2;
	}	
	
}

class Weak_and_slow_Robot extends Robot {

	public function getSpeed() {
		return 1;
	}
}

$newSlowRobot = new Weak_and_slow_Robot("Vasya");
$newQuickRobot = new Strong_and_quick_Robot("Semen");


$lb = new Labirint();
$lb -> enterRobot($newQuickRobot);
$lb -> enterRobot($newSlowRobot);


for ($i=0; $i<10; $i++){
	$lb->process();
	
	echo $newSlowRobot;
	echo "\n";
	echo $newQuickRobot;	
	echo "\n";

}

ss
?> 


