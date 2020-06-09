<?php
class ControllerOnlineLessons extends Controller
{
	public function action_index()
	{
		if ($this->user->role != 'Преподаватель')
			$this->title = 'Онлайн лекции';

		$this->own_view_path = 'onlineLessons-view.php';

		$this->setData([
			'']);
		$this->view->generate($this->data);
	}
}