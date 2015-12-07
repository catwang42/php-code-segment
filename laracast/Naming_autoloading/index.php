<?php 

// Namespacing and Autoloading
require 'vendor/autoload.php';

/*
$catherine = new Acme\Person('Catherine Wang');
$staff = new Acme\Sraff([$catherine]);
$afterplus = new Acme\Business($staff);
$afterplus->hire(new Acme\Person('Cici Fu'));


var_dump($laracasts->getStaffMembers()); */

?>

<?


// same as above code 

use Acme\Users\Person;
use Acme\Sraff;
use Acme\Business;


$catherine = new Person('Catherine Wang');
$staff = new Sraff([$catherine]);
$afterplus = new Business($staff);
$afterplus->hire(new Person('Cici Fu'));


var_dump($laracasts->getStaffMembers());

?>