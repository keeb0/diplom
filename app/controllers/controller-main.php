<?php
class ControllerMain extends Controller
{
	public function action_index()
	{
		$this->title = 'Главная';
		$this->own_view_path = 'main-view.php';
		
		$this->setData();
		
		$this->view->generate($this->data);
	}

	public function action_publish_news()
	{
		if (!empty($_SESSION['role'])) {
			if ($_SESSION['role'] != 'Администратор')
				$this->go_home();
		}
		if (!isset($_SESSION['user_id']))
			$this->go_home();

		$faculty = new ModelFaculty;
		$faculties = $faculty->fill();

		$department = new ModelDepartment();
		$departments = $department->fill();

		if (!empty($_POST)) {
			if (isset($_POST['title']) &&
				isset($_POST['departmentId']) &&
				isset($_POST['facultyId']) &&
				isset($_POST['text'])) {
				$news = new ModelNews($_POST);
				$news->publish();
				$this->error_message = $news->error_message;
			}
		}

		$this->title = 'Публикация новости';
		$this->own_view_path = 'main-view.php';
		$this->setData([
			'faculties' => $faculties,
			'departments' => $departments
		]);
		$this->view->generate($this->data);
	}
}