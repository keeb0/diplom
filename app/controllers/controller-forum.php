<?php
class ControllerForum extends Controller
{
	public function action_index()
	{
		$admin_button = null;
		$this->title = 'Форум';
		$this->own_view_path = 'forum/index-view.php';
		// $this->styles = array();

		if (!empty($this->user->role) and $this->user->role == 'Администратор')
			$admin_button =
				'<div class="admin_button">
					<a href="forum/createSection" class="admin_button">Создать секцию для форума</a>
				</div>';

		$this->model = new ModelForum;
		$this->model->getSections();
		$this->setData([
			'admin_button' => $admin_button]);
		$this->view->generate($this->data);
	}

	public function action_createSection()
	{
		$this->title = 'Создание секции';
		$this->own_view_path = 'forum/create-section-view.php';

		if (!empty($_POST)) {
			$this->model = new ModelForum($_POST);
			$this->error_message = $this->model->create();
		}

		$this->setData([
			'error_message' => $this->error_message,
			'faculties' => $this->faculty->list,
			'departments' => $this->department->list
		]);
		$this->view->generate($this->data);
	}
}