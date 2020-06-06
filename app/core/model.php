<?php
class Model
{
	static $connection;
	public $error_message = null;

	public function __construct()
	{
		self::$connection = new mysqli('localhost', 'admin', '123456', 'diplom');
		self::$connection->query("SET NAMES 'utf8'");
	}

	public function checkValidates($error_message)
	{
		$successful_validate = true;
		foreach ($error_message as $key => $value) {
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

class ModelSelectAllTable extends Model
{
	public $table;
	public $list;
	function __construct($table)
	{
		parent::__construct();
		$this->table = $table;
	}

	public function select()
	{
		$result = self::$connection->query("
			SELECT *
			FROM $this->table
		");
		$count = $result->num_rows;

		// Дополнительные поля для формы
		
		for ($i=0; $i < $count; $i++) { 
			$this->list[] = $result->fetch_assoc();
		}
		$result->close();
	}

	public function setDefaultOptions()
	{
		$this->list[] = array('id' => -1, 'name' => 'пусто');
		$this->list[] = array('id' => 0, 'name' => 'Для всех');
	}
}