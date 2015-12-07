<?php 

//showcase of how  different object passing messages to each other 
//concept , dependency, type hinting , type casting, 

class Person {

	protected $name;

	public function __construct($name)
	{

		$this->name = $name;
	}
}


class Business{

	protected $staff;

	public function __construct(Staff $staff)
	{
		$this->staff = $staff;
	}

	public function hire(Person $person)
	{
		$this->staff->add($person);

	}
	public function getStaffMembers()
	{
		return $this->staff->members();
	}
}


class Staff{

	protected $members = [];

	public function __construct($members = [])
	{

		$this->members = $members;
	}

	public function add(Person $person)
	{
		$this->members[] = $person;
	}

	public function members()
	{
		return $this->members;
	}
}


$catherine = new Person('Catherine Wang');
$staff = new Sraff([$catherine]);
$afterplus = new Business($staff);
$afterplus->hire(new Person('Cici Fu'));


?>