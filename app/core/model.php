<?php
class Model
{
	static $connection;
	public $error_message = null;

	public function __construct()
	{
		self::$connection = new mysqli('localhost', 'admin', '123456', 'chat');
		self::$connection->query("SET NAMES 'utf8'");
	}

	public function __destruct()
	{
		// self::$connection->close();
	}
}
