<?php
class ModelNews extends Model
{
	public $title;
	public $faculty;
	public $department;
	public $text;
	public $list;
	public $page;

	public $pervpage;
	public $page1left;
	public $page1right;
	public $page2left;
	public $page2right;
	public $nextpage;

	function __construct($form_data = null)
	{
		parent::__construct();
		if (!empty($form_data)) {
			foreach ($form_data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function showNews($table, $page, $facultyId = 0, $departmentId = 0)
	{
		$this->page = $page;
		$amount = 4;
		
		// счет количества доступных новостей
		$result = self::$connection->query("
			SELECT COUNT(*)
			FROM $table
			WHERE facultyId = 0
				OR (departmentId = 0 AND facultyId = $facultyId)
				OR (departmentId = $departmentId AND facultyId = $facultyId)
		");
		$row = $result->fetch_assoc();
		$news_amount = $row['COUNT(*)'];
		$this->total_page = ceil($news_amount / $amount);

		if ($this->page > $this->total_page) $this->page = $this->total_page;
		if ($this->page < 1) $this->page = 1;
		
		$begining = $this->page * $amount - $amount;

		// вывод доступных новостей на одну страницу
		$stmt = self::$connection->prepare("
			SELECT *
			FROM $table
			WHERE facultyId = 0
				OR (departmentId = 0 AND facultyId = $facultyId)
				OR (departmentId = $departmentId AND facultyId = $facultyId)
			ORDER BY id DESC
			LIMIT $begining, $amount
		");
		$stmt->execute();
		$result = $stmt->get_result();

		for ($i = 0; $i < $result->num_rows; $i++)
			$this->list[] = $result->fetch_assoc();
	}

	public function makePagination()
	{
		// Проверяем нужны ли стрелки назад
		if ($this->page != 1) $this->pervpage = '<a href=?page=1><<</a><a href=?page='.($this->page - 1) .'><</a> ';
		// Проверяем нужны ли стрелки вперед
		if ($this->page != $this->total_page)
			$this->nextpage = '<a href=?page='.($this->page + 1).'>></a><a href=?page='.$this->total_page.'>>></a>';

		// Находим две ближайшие станицы с обоих краев, если они есть
		if($this->page - 2 > 0)
			$this->page2left = '<a href=?page='.($this->page - 2).'>'.($this->page - 2).'</a>';
		if($this->page - 1 > 0)
			$this->page1left = '<a href=?page='.($this->page - 1).'>'.($this->page - 1).'</a>';
		if($this->page + 2 <= $this->total_page)
			$this->page2right = '<a href=?page='.($this->page + 2).'>'.($this->page + 2).'</a>';
		if($this->page + 1 <= $this->total_page)
			$this->page1right = '<a href=?page='.($this->page + 1).'>'.($this->page + 1).'</a>';
	}

	public function selectNews($group, $groupId, $begining, $amount)
	{
		
	}

	public function publish()
	{
		$error_message['title'] = $this->verifyTitle();
		$error_message['faculty'] = $this->verifyFaculty();
		$error_message['department'] = $this->verifyDepartment();
		$error_message['text'] = $this->verifyText();

		$successful_validate = $this->checkValidates($error_message);

		if ($successful_validate) {
			$stmt = self::$connection->prepare("
				INSERT INTO 
				news(title, text, facultyId, departmentId)
				VALUES(?,?,?,?)
			");
			$stmt->bind_param('ssii',$this->title, $this->text, $this->faculty, $this->department);
			$stmt->execute();
			setcookie('success_publish','true',time() + 3);
			header("Location: publish_news");
		}
		else
			return $error_message;
	}

	public function verifyTitle()
	{
		if (empty($this->title))
			return 'Заполните поле название';
	}
	public function verifyFaculty()
	{
		if ($this->faculty == -1)
			return 'Укажите факультет';
	}
	public function verifyDepartment()
	{
		if ($this->department == -1)
			return 'Укажите кафедру';
	}
	public function verifyText()
	{
		if (empty($this->text))
			return 'Заполните поле текст';
	}
}

class ModelTeacherList extends Model
{
	public $teachers;
	public function getList($facultyId, $departmentId)
	{
		$result = self::$connection->query("
			SELECT id, firstname, surname, patronymic
			FROM users
			WHERE facultyId = $facultyId
				AND departmentId = $departmentId
				AND roleId = 1
				");
		for ($i=0; $i < $result->num_rows; $i++) { 
			$teachers[] = $result->fetch_assoc();
		}
		foreach ($teachers as $key => $value) {
			$teachers[$key]['fullname'] = $value['surname'].' '.
			mb_strcut($value['firstname'], 0, 2).'.'.
			mb_strcut($value['patronymic'], 0, 2).'.';
		}
		// print_r($teachers);
		$this->teachers = $teachers;
	}
	
}
