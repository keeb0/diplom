<?php
class ModelNews extends Model
{
	public $title;
	public $facultyId;
	public $departmentId;
	public $text;
	function __construct($form_data)
	{
		parent::__construct();
		foreach ($form_data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function select()
	{
		self::$connection->query("
			SELECT *
			FROM news ");
	}

	public function publish()
	{
		$this->error_message['title'] = $this->verifyTitle();
		$this->error_message['facultyId'] = $this->verifyFacultyId();
		$this->error_message['departmentId'] = $this->verifyDepartmentId();
		$this->error_message['text'] = $this->verifyText();

		$successful_validate = $this->checkValidates();

		if ($successful_validate) {
			$stmt = self::$connection->prepare("
				INSERT INTO 
				news(title, text, facultyId, departmentId)
				VALUES(?,?,?,?)
				");
			$stmt->bind_param('ssii',$this->title, $this->text, $this->facultyId, $this->departmentId);
			$stmt->execute();
		}
	}

	public function verifyTitle()
	{
		if (empty($this->title))
			return 'Заполните поле название';
	}
	public function verifyFacultyId()
	{
		if ($this->facultyId == -1)
			return 'Выберите факультет';
	}
	public function verifyDepartmentId()
	{
		if ($this->departmentId == -1)
			return 'Выберите кафедру';
	}
	public function verifyText()
	{
		if (empty($this->text))
			return 'Заполните поле текст';
	}
}

class ModelFaculty extends Model
{
	public $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'faculties';
	}
	public function fill()
	{
		$result = self::$connection->query("
			SELECT id, name
			FROM $this->table
			");
		$count = $result->num_rows;

		// Дополнительные поля для формы
		$rows[] = array('id' => -1, 'name' => 'пусто');
		$rows[] = array('id' => 0, 'name' => 'Для всех');
		for ($i=0; $i < $count; $i++) { 
			$rows[] = $result->fetch_assoc();
		}
		$result->close();
		return $rows;
	}
}
class ModelDepartment extends ModelFaculty
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'departments';
	}
}