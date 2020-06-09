<?php
class ModelSubjects extends Model
{
	public $list;
	public $chosen_subjects;

	public function getSubjects($facultyId, $departmentId, $semester)
	{
		$error_message = array();
		if ($semester < 1 or $semester > 20)
			$error_message['semester'] = 'Некорректно указан семестр';

		$successful_validate = $this->checkValidates($error_message);

		if ($successful_validate) {
			$stmt = self::$connection->prepare("
			SELECT *
			FROM subjects
			WHERE facultyId = $facultyId AND departmentId = $departmentId
				AND semester = $semester
				");
			$stmt->execute();
			$result = $stmt->get_result();
			for ($i=0; $i < $result->num_rows; $i++)
				$this->list[] = $result->fetch_assoc();
			return null;
		}
		else
			return $error_message;
	}

	public function addSubjects($subjects, $user_id)
	{
		$this->chosen_subjects = $subjects;
		$amount = count($this->chosen_subjects);
		$this->validateSubjects();
		$successful_validate = $this->checkValidates($this->error_message);

		if ($successful_validate) {
			for ($i=0; $i < $amount; $i++) {
				$stmt = self::$connection->prepare("
					INSERT INTO subjectsUsers
					VALUES (?,?)
				");
				$stmt->bind_param('ii', $user_id, $this->chosen_subjects[$i]);
				$stmt->execute();
				$stmt->close();
			}
		}
	}

	public function getDocs($subjectId)
	{
		$this->documents = null;
		$stmt = self::$connection->prepare("
			SELECT *
			FROM teacherDocs
			WHERE subjectId = $subjectId
		");
		$stmt->execute();
		$result = $stmt->get_result();
		for ($i=0; $i < $result->num_rows; $i++) { 
			$this->documents[] = $result->fetch_assoc();
		}
		// print_r($documents);
	}

	public function validateSubjects()
	{
		if (empty($this->chosen_subjects))
			$this->error_message['subjects'] = 'Выберите предметы';
	}
}