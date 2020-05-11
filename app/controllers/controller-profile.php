<?php
class Controller_Profile extends Controller
{
	public $view_directory = 'profile/';

	public function __construct()
	{
		parent::__construct();

		$this->scripts = array('script.js');
		$this->styles = array('forms-profile.css');
	}

	public function action_index()
	{
		$this->title = 'Личный кабинет';
		$this->own_view_path = 'profile-edit-view.php';

		if (!isset($_SESSION['user_id']))
			$this->go_home();

		// *********Блок кода с модулем аватарки пользователя*********
		$user_avatar = new Model_User_Avatar($this->user);
		$user_avatar->getAvatar();

		if (!empty($_FILES)) {
			list($file_name, ) = each($_FILES);
			
			if(!empty($_FILES[$file_name]['tmp_name']))
			{
				$this->error_message = $user_avatar->upload($_FILES[$file_name],
					$this->user->user_id);
			}
		}

		// *********Блок кода с модулем данных пользователя*********
		if (!empty($_POST)) {
			if (!empty($_POST['remove_confirm'])) {
				$user_avatar->remove();
			}
			else {
				$user_editing = new Model_User($_POST);

				if (isset($user_editing->login) || isset($user_editing->email))
					$this->error_message = $user_editing->editData($this->user->user_id);

				elseif (!empty($user_editing->pswd)) {
					$user_editing->login = $this->user->login;

					if ($user_editing->verifyPswd())
						$this->error_message = $user_editing->editPswd($this->user->user_id);
					else
						$this->error_message['pswd'] = 'Не верный пароль';
				}
				else
					$this->error_message['pswd'] = 'Введите пароль';
			}
		}

		$this->setData(['avatar' => $user_avatar->path_get]);

		$this->view->generate($this->data);
	}

	public $desired_user;

	public function action_show_user()
	{
		$this->own_view_path = 'show-user-view.php';
		if (isset($_GET['user_id'])) {
			$this->desired_user = new Model_User($_GET);
			$this->desired_user->getData();
		}
		else
			$this->go_home();

		$this->title = 'Профиль пользователя '.$this->desired_user->login;

		$user_avatar = new Model_User_Avatar($this->desired_user);
		$user_avatar->getAvatar();

		$this->setData(
			['avatar' => $user_avatar->path_get,
			'desired_user' => $this->desired_user]);

		$this->view->generate($this->data);
	}
}