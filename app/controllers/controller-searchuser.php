<?php
class ControllerSearchUser extends Controller
{
	public $matching_users;

	public function action_index()
	{
		$this->title = 'Поиск пользователя';
		$this->own_view_path = 'search-user-view.php';
		$this->styles[] = 'search-user.css';
		
		$searching_user = new ModelSearchUser;

		if (isset($_POST['desired_user_login']))
			$this->matching_users = $searching_user->search($_POST['desired_user_login']);

		$this->error_message = $searching_user->error_message;

		$this->setData([
			'error_message' => $this->error_message,
			'matching_users' => $this->matching_users]
		);

		$this->view->generate($this->data);
	}
}