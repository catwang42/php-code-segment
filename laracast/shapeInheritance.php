<?php 

//showcase of enclosing, abstract class, abstract funciton 

abstract class Shape {

	protected $color;
	public function __construct($color = 'red')
	{
		$this->color = $color
	}

	public function getColor()
	{
		return $this->color;
	}

	abstract public function getArea();
}

class Square extends Shape{

	protected $length = 4;

	public function getArea()
	{
		return pow($this->length,2);
	}
}

class Triangle extends Shape{

	protected $base = 4;
	protected $height = 7;

	public function getArea()
	{
		return .5 * $this->base * $this->height;
	}
}

class Circle extends Shaoe{
	protected $radius = 5;

	public function getArea()
	{
		return M_PI * pow($this->radius,2);
	}
}

echo (new Circle())->getColor();
(new Circle)->getArea();

?>

<?php 

abstract class Mailer {

	public function send($to, $from, $body)
	{
		//
	}
}

class UserMailer extends Mailer {

	public function sendWelcomeEmail(User $user)
	{
		return $this->send($user->email);
	}
}


?>