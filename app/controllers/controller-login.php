<?php
class Controller_Login extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->styles[] = 'forms-login-sign-up.css';
	}
	public function action_index()
	{
		$this->title = 'Вход';
		$this->own_view_path = 'login-view.php';
		
		if(isset($_SESSION['user_id']))
			$this->go_home();

		if(!empty($_POST))
		{
			if(!empty($_POST['login'])
				&& !empty($_POST['pswd']))
			{
				$guest = new Model_User($_POST);
				$successful_query = $guest->verifyPswd();

				if($successful_query['id'] !== false)
					{
						$_SESSION['user_id'] = $successful_query['id'];
						$_SESSION['role'] = $successful_query['role'];
						$this->go_home();
					}
				else
					$this->error_message = 'Не верный логин или пароль';
			}
			else
				$this->error_message = 'Заполните все поля';
		}

		$this->setData();

		$this->view->generate($this->data);
	}

	public function action_logout()
	{
		session_destroy();
		header("Location: /");
	}
}