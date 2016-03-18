<?php
class Dress {
	private $color = 'red';
	private $price = 22;
	private $number = 0;
	private $shop;

	public function set_dress_color($color) {
		$this->color = $color;
	}

	public function get_dress_color() {
		return $this->color;
	}

	public function __construct($color, $price, $number, $shop) {
		$this->color=$color;
		$this->price=$price;
		$this->number=$number;
		$this->shop=$shop;  
	} 

	// public function __construct($number) {
	// 	$this->number=$number; 
	// } 

	public function display_all_fields() {
		foreach($this as $key => $value) {
			echo "\t $value";
		}
	}
}

	$dr1 = new Dress("red", "2000", "2", "ooo");
	
	//echo $dr1->price ;

	echo "dress with color:".$dr1->get_dress_color()." color <br>";
	$dr2 = new Dress("green", "1000", "4", "zara");
	$dr2->display_all_fields(); 
?>