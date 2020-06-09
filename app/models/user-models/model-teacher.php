<?php
class ModelTeacher extends ModelUser
{
	const DOC_DIR = 'web/user/teacher-docs';

	public function uploadDoc($form_data, $user_id)
	{
		$error_message['title'] =  $this->verifyTitle($form_data[0]['title']);
		$error_message['altLink'] =  $this->verifyAltLink($form_data[0]['altLink']);
		$error_message['description'] =  $this->verifyDescription($form_data[0]['description']);
		$error_message['author'] =  $this->verifyAuthor($form_data[0]['author']);
		$error_message['pages'] =  $this->verifyPages($form_data[0]['pages']);
		$error_message['year'] =  $this->verifyYear($form_data[0]['year']);
		$error_message['subjectId'] =  $this->verifysubject($form_data[0]['subjectId']);

		$successful_validate = $this->checkValidates($error_message);
		if ($successful_validate) {
			$stmt = self::$connection->prepare("
				INSERT INTO teacherDocs
				(title, userId, altLink, description, author, pages, year, subjectId)
				VALUES(?,?,?,?,?,?,?,?)
			");
			$stmt->bind_param(
				'sisssisi', $form_data[0]['title'],
				$user_id,$form_data[0]['altLink'],
				$form_data[0]['description'],
				$form_data[0]['author'],
				$form_data[0]['pages'],
				$form_data[0]['year'],
				$form_data[0]['subjectId']
			);
			$stmt->execute();
			$id = self::$connection->insert_id;

			if (!file_exists('web/user/teacher-docs/teacher-'.$user_id))
				mkdir('web/user/teacher-docs/teacher-'.$user_id);

			if (!empty($_FILES['document']['name'])) {

				$type = explode('.', $_FILES['document']['name']);
				$type = end($type);
				$temp_name = uniqid().'.'.$type;
				move_uploaded_file($_FILES['document']['tmp_name'], 'web/user/teacher-docs/teacher-'.$user_id.'/'.$temp_name);

				$stmt = self::$connection->prepare("
					UPDATE teacherDocs
					SET hashName = ?
					WHERE id = $id
				");
				$stmt->bind_param('s', $temp_name);
				$stmt->execute();
			}
		}
		else
			return $error_message;
	}

	public function verifyTitle($title)
	{
		if (empty($title))
			return 'Заполните поле название';
	}
	public function verifyAltLink($altLink)
	{
		if (empty($_FILES['document']['name']) and empty($altLink))
			return 'Загрузите документ или введите ссылку на него';
	}
	public function verifyDescription($description)
	{
		if (empty($description))
			return 'Заполните поле описание';
	}
	public function verifyAuthor($author)
	{
		if (empty($author))
			return 'Заполните поле автор';
	}
	public function verifyPages($pages)
	{
		if (empty($pages))
			return 'Введите количество страниц';
	}
	public function verifyYear($year)
	{
		if (empty($year))
			return 'Введите год написания методички';
	}
	public function verifysubject($subjectId)
	{
		if ($subjectId < 1)
			return 'Укажите предмет';
	}
}