<?php
class ControllerMain extends Controller
{
	public $faculty;
	public $department;

	public function __construct()
	{
		parent::__construct();

		$this->faculty = new ModelFaculty('faculties');

		$this->department = new ModelDepartment('departments');
	}

	public function action_index()
	{
		$button = null;
		$this->title = 'Главная';
		$this->own_view_path = 'main/index-view.php';
		
		if (empty($_GET['page']))
			$page = 1;
		else
			$page = $_GET['page'];

		$news = new ModelNews();
		isset($this->user) ?
			$news->showNews('news', $page, $this->user->facultyId, $this->user->departmentId) :
			$news->showNews('news', $page);
		$news->makePagination();

		// Условия при которых кнопка создания новостей выводится только у Администратора
		if (!empty($this->user->role) and $this->user->role == 'Администратор')
			$button = '<div class="admin_button">
							<a href="/main/publish_news">Опубликовать новость</a>
						</div>';

		$this->setData([
			'news' => $news->list,
			'page' => $news->page,
			'total_page' => $news->total_page,
			'button' => $button,
			'page_list' => [
				'nextpage' => $news->nextpage,
				'pervpage' => $news->pervpage,
				'page2left' => $news->page2left,
				'page1left' => $news->page1left,
				'page2right' => $news->page2right,
				'page1right' => $news->page1right,
			]	
		]);
		$this->view->generate($this->data);
	}

	public function action_publish_news()
	{
		if ($this->user->role != 'Администратор' OR !isset($this->user))
			$this->go_home();

		if (!empty($_POST)) {
			if (isset($_POST['title']) && isset($_POST['department']) &&
				isset($_POST['faculty']) && isset($_POST['text'])) {

				$news = new ModelNews($_POST);
				$news->publish();
				$this->error_message = $news->error_message;
			}
		}

		$this->title = 'Публикация новости';
		$this->own_view_path = 'main/publish-news-view.php';
		$this->setData([
			'faculties' => $this->faculty->list,
			'departments' => $this->department->list
		]);
		$this->view->generate($this->data);
	}
}