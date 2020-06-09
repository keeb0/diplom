<?php
class Controller
{
	public $view;
	public $model;
	public $user;
	public $template_view_path = 'template-view.php';
	public $own_view_path;
	public $title;
	public $data;
	public $error_message = null;
	public $styles = null;
	public $scripts = null;
	public $faculty;
	public $department;

	const USER_MODEL_DIR = 'app/models/user-models/';

	public function __construct()
	{
		$this->view = new View;
		if (!empty($_SESSION['user_id'])) {
			switch ($_SESSION['role']) {
				case 'Администратор':
					require_once self::USER_MODEL_DIR.'model-admin.php';
					$this->user = new ModelAdmin($_SESSION);
					break;
				
				case 'Преподаватель':
					require_once self::USER_MODEL_DIR.'model-teacher.php';
					$this->user = new ModelTeacher($_SESSION);
					break;

				case 'Студент':
					require_once self::USER_MODEL_DIR.'model-student.php';
					$this->user = new ModelStudent($_SESSION);
					break;
			}
			$this->user->getData();
		}
		$this->faculty = new ModelSelectAllTable('faculties');
		$this->faculty->setDefaultOptions('факультет');
		$this->faculty->select();
		
		$this->department = new ModelSelectAllTable('departments');
		$this->department->setDefaultOptions('кафедру');
		$this->department->select();	
	}

	public function setData($special_data = null)
	{
		$this->data = array(
			'content_view' => $this->own_view_path,
			'template_view' => $this->template_view_path,
			'styles' => $this->styles,
			'scripts' => $this->scripts,
			'user' => $this->user,
			'title' => $this->title,
			'error_message' => $this->error_message
		);

		if (!empty($special_data)) {
			foreach ($special_data as $key => $value)
				$this->data[$key] = $value;
		}
	}

	public function kickNoUser()
	{
		if (!isset($_SESSION['user_id']))
			$this->go_home();
	}

	public function go_home()
	{
		header("Location: /");
	}
}
