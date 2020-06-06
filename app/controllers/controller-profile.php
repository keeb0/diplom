<?php
class ControllerProfile extends Controller
{
	public $view_directory = 'profile/';

	public function __construct()
	{
		parent::__construct();

		$this->scripts = array('script.js');
		$this->styles = array('forms-profile.css');
		$this->own_view_path = 'profile-view.php';
	}

	public function action_index()
	{
		$this->title = 'Личный кабинет';

		if (!isset($_SESSION['user_id']))
			$this->go_home();

		// *********Блок кода с модулем аватарки пользователя*********
		$user_avatar = new ModelUserAvatar($this->user);
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
				$user_editing = new ModelUser($_POST);

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
		if (isset($_GET['user_id'])) {
			$this->desired_user = new ModelUser($_GET);
			$this->desired_user->getData();
		}
		else
			$this->go_home();

		if ($this->desired_user->role == 'Преподаватель') {
			$show_docs_button = '<a class="buttons" href="/profile/showDocs?user_id='.$this->desired_user->user_id.'">Методички</a>';
		}
		else
			$show_docs_button = null;
		$this->title = 'Профиль пользователя '.$this->desired_user->login;

		$user_avatar = new ModelUserAvatar($this->desired_user);
		$user_avatar->getAvatar();

		$this->setData(
			['avatar' => $user_avatar->path_get,
			'desired_user' => $this->desired_user,
			'show_docs_button' => $show_docs_button
		]);

		$this->view->generate($this->data);
	}

	public function action_uploadDoc()
	{
		$this->title = 'Загрузка методички';
		$this->own_view_path = 'profile/uploadDoc-view.php';
		$this->scripts[] = 'script-uploadDoc.js';

		if (!empty($_POST)) {
			$this->error_message = $this->user->uploadDoc([$_POST, $_FILES], $this->user->user_id);
		}
		$subjects = new ModelSelectAllTable('subjects');
		$subjects->select();
		$this->setData([
			'error_message' => $this->error_message,
			'subjects' => $subjects->list,
		]);
		$this->view->generate($this->data);
	}

	public function action_showDocs()
	{
		// if (!isset($_GET['user_id']))
			// $this->go_home();
		$this->title = 'Список методичек';
		$this->own_view_path = 'profile/showDocs-view.php';
		$documents = 0;

		if (isset($_POST['subjectId']) and !empty($_POST['subjectId'])) {
			$documents = $this->user->getTeacherDocs($_GET['user_id'], $_POST['subjectId']);
		}

		$this->model = new ModelShowDocs();
		$subjects = $this->model->getSubjects($this->user->facultyId, $this->user->departmentId);
		
		$this->setData([
			// 'error_message' => $this->error_message,
			'documents' => $documents,
			'subjects' => $subjects
		]);
		$this->view->generate($this->data);
	}
}