<?php
class ControllerForum extends Controller
{
	public function action_index()
	{
		$this->title = 'Форум';
		$this->own_view_path = 'forum-view.php';
		// $this->styles = array();

		$this->model = new ModelForum;
		$this->setData();
	}
}