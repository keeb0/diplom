<?php
class ControllerSignUp extends Controller
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
			$new_user = new ModelUser($_POST);
			$result = $new_user->create();

			// Успешная регистрация
			if($result === true)
				$this->go_home();
			else
				$this->error_message = $result;
		}

		$this->setData();
		$this->view->generate($this->data);
	}
}