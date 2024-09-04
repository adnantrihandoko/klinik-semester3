<?php
namespace App;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

class Database{

	private $servername; 
	private $username; 
	private $password;
	private $dbname;

	public function __construct() {
		$this->servername = $_ENV['DB_HOST'];
		$this->username = $_ENV['DB_USERNAME'];
		$this->password = $_ENV['DB_PASSWORD'];
		$this->dbname = $_ENV['DB_DATABASE'];
	}

	private static function make($host, $db, $user, $password){
		$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
		try {
			$options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
			return new \PDO($dsn, $user, $password, $options);
		} catch (\PDOException $e) {
			die($e->getMessage());
		}
	}

	public function connect() {
        return self::make($this->servername, $this->dbname, $this->username, $this->password);
    }
}

?>