<?php
class Controller_404 extends Controller
{
	function action_index()
	{
		$this->title = '404 Not Found';
		$this->template_view_path = '404-view.php';
		$this->setData();
		$this->view->generate($this->data);
	}
}