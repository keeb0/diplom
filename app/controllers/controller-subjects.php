<?php
class ControllerSubjects extends Controller
{
	public function action_docs()
	{
		$this->title = 'Методички ';
		$this->own_view_path = 'subjects/docs-view.php';

		if (isset($_GET['subject_id']) and !empty($_GET['subject_id']) and is_numeric($_GET['subject_id'])) {
			$this->model = new ModelSubjects;
			$this->model->getDocs($_GET['subject_id']);
		}
		else
			header('location: /subjects');

		$this->setData([
			'documents' => $this->model->documents]);
		$this->view->generate($this->data);
	}
	public function action_index()
	{
		$this->kickNoUser();
		$this->title = 'База знаний';
		$this->own_view_path = 'subjects/manage-view.php';
		$this->styles[] = 'search-user.css';

		// $subjects = new ModelSelectAllTable('subjects');
		// $subjects->setDefaultOptions('предмет', null);
		// $subjects->select();
		// print_r($subjects);

		// $select_semester = '<select name=semester><option value=0>Укажите семестр</option>';
		// for ($i=1; $i < 9; $i++) 
		// 	$select_semester .= '<option value='.$i.'>'.$i.'</option>';
		// $select_semester .= '</select>';

		

		$subject = new ModelSubjects;
		if (isset($_POST['semester'])) {
			$this->error_message = $subject->getSubjects($this->user->facultyId, $this->user->departmentId, $_POST['semester']);
		}

		if (isset($_POST['chosen_subjects']) and !empty($_POST['chosen_subjects'])) {
			// print_r($_POST['chosen_subjects']);

			$subject->addSubjects($_POST['chosen_subjects'], $this->user->user_id);
		}

		$this->setData([
			'subjects' => $subject->list,
			'error_message' => $this->error_message,
			'faculties' => $this->faculty->list,
			'departments' => $this->department->list
		]);
		$this->view->generate($this->data);
	}
}