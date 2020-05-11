<?php
class Controller_Sign_Up extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->styles[] = 'forms-login-sign-up.css';
		$this->scripts[] = 'script-sign-up.js';
	}
	public function action_index()
	{
		$this->title = 'Регистрация';
		$this->own_view_path = 'sign-up-view.php';
		
		if(isset($_SESSION['user_id']))
			$this->go_home();

		if(!empty($_POST))
		{
			$new_user = new Model_User($_POST);
			$this->error_message = $new_user->create();

			// Успешная регистрация
			if($this->error_message === 1)
				$this->go_home();
		}

		$this->setData();
		
		$this->view->generate($this->data);
	}
}