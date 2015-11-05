<?php
//Filename: IConnectInfo.php
interface IConnectInfo
{
	const HOST ="your_host";
	const UNAME ="your_username";
	const PW ="your_pw";
	const DBNAME = "your_dbname";
	public static function doConnect();
}
?>
 
<?php
//Filename: UniversalConnect.php
ini_set("display_errors","1");
ERROR_REPORTING( E_ALL | E_STRICT );
include_once('IConnectInfo.php');
 
class UniversalConnect implements IConnectInfo
{
	private static $server=IConnectInfo::HOST;
	private static $currentDB= IConnectInfo::DBNAME;
	private static $user= IConnectInfo::UNAME;
	private static $pass= IConnectInfo::PW;
	private static $hookup;
 
	public static function doConnect()
	{
		self::$hookup=mysqli_connect(self::$server, self::$user, self::$pass, self::$currentDB);
		try
		{	
			self::$hookup;
			//Uncomment following line for develop/debug
			echo "Successful MySql connection:<br />";
		}
		catch (Exception $e)
		{
			echo "There is a problem: " . $e->getMessage();
			exit();
		}
		return self::$hookup;
	}
}
?>
 
<?php
include_once('IConnectInfo.php');
include_once('UniversalConnect.php');
class CreateTable
{
	private $drop;
 
	public function __construct()
	{
		$this->hookup=UniversalConnect::doConnect();
		$this->tableMaster="your_table_name";
		$this->dropTable();
		$this->makeTable();
		$this->hookup->close();	
	}
 
	private function dropTable()
	{
		$this->drop = "DROP TABLE IF EXISTS $this->tableMaster";
 
		try
		{
			$this->hookup->query($this->drop) === true;
			printf("Old table %s has been dropped.<br />",$this->tableMaster);
		}
		catch (Exception $e)
		{
			echo "Here is why it did not work:  $e->getMessage() <br />";
		}
	}
 
	protected function makeTable()
	{
		$this->sql = "CREATE TABLE $this->tableMaster (
			id SERIAL,
			topic NVARCHAR(24),
			header NVARCHAR(120),
			graphic NVARCHAR(60),
			story BLOB,
			PRIMARY KEY (id))";
		try
		{
		  $this->hookup->query($this->sql);
 
		}
		 catch (Exception $e)
		{
			echo 'Here is why it did not work: ',  $e->getMessage(), "<br />";
		}
		echo "Table $this->tableMaster has been created successfully.<br />";
	}
}
 
$worker=new CreateTable();
?>