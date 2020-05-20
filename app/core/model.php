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

	public function checkValidates()
	{
		$successful_validate = true;
		foreach ($this->error_message as $key => $value) {
			if (!empty($value)) {
				$successful_validate = false;
				break;
			}
		}
		return $successful_validate;
	}

	public function __destruct()
	{
		// self::$connection->close();
	}
}
