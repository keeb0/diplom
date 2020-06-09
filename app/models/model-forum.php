<?php
class ModelForum extends Model
{
	public $name;
	public $faculty;

	function __construct($form_data = null)
	{
		parent::__construct();
		if (!empty($form_data)) {
			foreach ($this as $key => $value) {
				if (!empty($form_data[$key])) {
					$this->$key = $form_data[$key];
				}
			}
		}
	}

	public function getSections($facultyId)
	{

	}
	public function create()
	{
		$error_message['name'] = $this->verifyName();
		$error_message['faculty'] = $this->verifyFaculty();

		$successful_validate = $this->checkValidates($error_message);

		if ($successful_validate) {
			$stmt = self::$connection->prepare("
				INSERT INTO forumSections(name, facultyId)
				VALUES(?,?)
			");
			$stmt->bind_param('si',$this->name, $this->faculty,);
			$stmt->execute();
			setcookie('success_create','true',time() + 3);
			header("Location: createSection");
		}
		else
			return $error_message;
	}

	public function verifyName()
	{
		if (empty($this->name))
			return 'Заполните поле название';
	}
	public function verifyFaculty()
	{
		if ($this->faculty < 1)
			return 'Укажите факультет';
	}
}