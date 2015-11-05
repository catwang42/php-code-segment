<?php
class LoginProxy extends ILogin
{
	//Proxy Subject
	public function doLogin()
	{ 	
		$this->sun=$_GET['username'];
		unset($_GET['username']);
		$this->spw=$_GET['password'];
		unset($_GET['password']);
 
		try
		{
			$this->security=$this->setPass();
			$this->igor=$this->sun==base64_decode($this->security[0]) && $this->spw==base64_decode($this->security[1]);
			$lambda=function($x) {$alpha=$this->igor ? $this->passSecurity=true : NULL; return $alpha;};
			$lambda($this->igor);
			$this->loginOrDie();
		}
 
		catch(Exception $e)
		{
			echo "Here's what went wrong: " . $e->getMessage();
		}
	}
 
	protected function loginOrDie()
	{
		$badPass=function($x) {$delta= $x ? ($this->goodLog=new Login()) : ($this->badLog=new ReLog());};
		$badPass($this->passSecurity);
		$goodPass=function($x) {$tau= $x ? ($this->goodLog->doLogin()) : NULL;};
		$goodPass($this->passSecurity);
	}
}

class Login extends ILogin
{
	//Real Subject
	public function doLogin()
	{ 
		$this->loginOrDie();
	}
 
	protected function loginOrDie()
	{
		$admin=new AdminUI();
		$admin->dataStrat();
	}
}

abstract class ILogin
{
	protected abstract function loginOrDie();
	public abstract function doLogin();
	protected $sun, $spw, $igor, $goodLog, $badLog;
	protected $security = array();
	protected $passSecurity=false;
	protected function setPass()
	{
		$aduser=base64_encode("a");
		$adcode=base64_encode("b");
		$enigma=array($aduser,$adcode);
		return $enigma;
	}
}

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
function includeAll($className)
{
    include_once($className . '.php');
}
spl_autoload_register('includeAll');
 
class LoginClient
{
    private static $login;
    //client request
    public static function request()
    {
      self::$login=new LoginProxy();
      self::$login->doLogin();
    }
}
LoginClient::request();

	

	$this->sun=$_GET['username'];
	unset($_GET['username']);
	$this->spw=$_GET['password'];
	unset($_GET['password']);


?>