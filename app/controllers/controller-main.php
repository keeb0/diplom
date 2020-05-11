<?php
class Controller_Main extends Controller
{
	public function action_index()
	{
		$this->title = 'Главная';
		$this->own_view_path = 'main-view.php';
		
		$this->setData();
		
		$this->view->generate($this->data);
	}
}