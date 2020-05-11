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

	const USER_MODEL_DIR = 'app/models/user-models/';

	public function __construct()
	{
		$this->view = new View;
		if (!empty($_SESSION))
		{
			switch ($_SESSION['role']) {
				case 'admin':
					require_once self::USER_MODEL_DIR.'model-admin.php';
					$this->user = new Model_Admin($_SESSION);
					break;
				
				case 'teacher':
					require_once self::USER_MODEL_DIR.'model-teacher.php';
					$this->user = new Model_Teacher($_SESSION);
					break;

				case 'Студент':
					require_once self::USER_MODEL_DIR.'model-student.php';
					$this->user = new Model_Student($_SESSION);
					break;
			}
			$this->user->getData();
		}
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

	public function go_home()
	{
		header("Location: /");
	}
}
