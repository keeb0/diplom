<?php
class ModelUser extends Model
{
	public $user_id;
	public $login;
	public $firstname;
	public $surname;
	public $patronymic;
	public $departmentId;
	public $facultyId;
	public $email;
	public $role;
	public $avatar_name;
	public $pswd;
	public $pswd_new;
	public $pswd_conf;

	//Конструктор (присвоение свойствам класса элементы массива $user_info)
	public function __construct($user_data)
	{
		parent::__construct();

		foreach ($user_data as $key => $value)
			$this->$key = $value;
	}

	// Передача данных по id для заполнения свойств объекта
	public function getData()
	{
		$stmt = self::$connection->prepare("
			SELECT login, email, avatar_name, role, departmentId, facultyId
			FROM users, roles
			WHERE users.id = '$this->user_id'
				AND roles.id = users.roleId
		");
		$stmt->execute();
		$result_set = $stmt->get_result();
		$stmt->close();
		$row = $result_set->fetch_array(MYSQLI_ASSOC);

		foreach ($row as $key => $value)
			$this->$key = $value;
	}

	// Запись нового пользователя
	public function create()
	{
		// Указан не корректный id -1 (пользователь еще не создан)
		$existing_user = $this->getExistingUser(-1);
		$error_message['login'] = $this->validateLogin($existing_user['login']);
		$error_message['email'] = $this->validateEmail($existing_user['email']);
		$error_message['role'] = $this->validateRole();
		$error_message['firstname'] = $this->validateFirstname();
		$error_message['surname'] = $this->validateSurname();
		$error_message['patronymic'] = $this->validatePatronymic();
		$error_message['department'] = $this->validateDepartmentId();
		$error_message['faculty'] = $this->validateFacultyId();
		$error_message['pswd'] = $this->validatePswd();
		print_r($this);

		$successful_validate = $this->checkValidates($error_message);
		
		if ($successful_validate) {
			$this->pswd_new = password_hash($this->pswd_new, PASSWORD_DEFAULT);
			$stmt = self::$connection->prepare("
				INSERT INTO users
				VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, NULL, ?)
			");
			$stmt->bind_param(
				'sssssiiis', $this->login, $this->email,
				$this->firstname, $this->surname, $this->patronymic,
				$this->role, $this->facultyId, $this->departmentId,
				$this->pswd_new
				);
			$stmt->execute();
			$_SESSION['user_id'] = self::$connection->insert_id;

			$result = self::$connection->query("
				SELECT role
				FROM roles
				WHERE id = '$this->role'
			");
			$row = $result->fetch_assoc();

			$_SESSION['role'] = $row['role'];
			setcookie('checkIn', true, time() + 3);
			return true;
		}
		else
			return $error_message;
	}

	// Редактирование данных пользователем
	public function editData($user_id)
	{
		$existing_user = $this->getExistingUser($user_id);
		$error_message['login'] = $this->validateLogin($existing_user['login']);
		$error_message['email'] = $this->validateEmail($existing_user['email']);

		$successful_validate = $this->checkValidates($error_message);
	
		if ($successful_validate) {
			foreach ($this as $key => $value) {
				if (!empty($value) && $key != 'data_updating') {
					$stmt = self::$connection->prepare("
						UPDATE users
						SET $key = ?
						WHERE id = '$user_id'
					");
					$stmt->bind_param('s', $value);
					$stmt->execute();
				}
			}
			header("Location: profile");
		}
		else
			return $error_message;
	}

	public function editPswd($user_id)
	{
		$error_message['pswd'] = $this->validatePswd();
		$successful_validate = $this->checkValidates($error_message);

		if ($successful_validate) {
			$this->pswd_new = password_hash($this->pswd_new, PASSWORD_DEFAULT);
			$stmt = self::$connection->prepare("
				UPDATE users
				SET password = ?
				WHERE id = '$user_id'
			");
			$stmt->bind_param('s', $this->pswd_new);
			$stmt->execute();
			header("Location: profile");
		}
		else
			return $error_message;
	}

	// Проверка незанятости login и email во время редактиривания
	public function getExistingUser($user_id)
	{
		$stmt = self::$connection->prepare("
			SELECT email, login 
			FROM users 
			WHERE id <> '$user_id' 
				AND (login = '$this->login' 
				OR email = '$this->email')
		");
		$stmt->execute();
		$result_set = $stmt->get_result();
		$row = $result_set->fetch_assoc();
		return $row;
	}

	// Проверка введных данных при входе
	public function verifyPswd()
	{
		$stmt = self::$connection->prepare("
			SELECT users.id, role, password
				AS 'hash'
			FROM users, roles
			WHERE users.login = ?
				AND users.roleId = roles.id
		");
		$stmt->bind_param('s', $this->login);
		$stmt->execute();
		$result_set = $stmt->get_result();
		$row = $result_set->fetch_assoc();

		if (password_verify($this->pswd, $row['hash'])) 
			return [
				'id' => $row['id'],
				'role'=> $row['role']
			];
		else
			return false;
	}

	public function getTeacherDocs($user_id, $subjectId)
	{
		$docs_id = null;

		$result = self::$connection->query("
			SELECT *
			FROM teacherdocs
			WHERE userId = $user_id AND subjectId = $subjectId
			");
		for ($i=0; $i < $result->num_rows; $i++) { 
			$docs_id[] = $result->fetch_assoc();
		}
		return $docs_id;
	}

	public function validateLogin($existing_login)
	{
		if (empty($this->login))
			return' Заполните поле логин';
		elseif (preg_match('/\W/', $this->login))
			return 'Логин может включать латинские буквы (a-z), цифры (0-9) и знак _';
		elseif ($existing_login == $this->login)
			return 'Пользователь с таким логином уже существует!';
		return '';
	}

	public function validateEmail($existing_email)
	{
		if (empty($this->email))
			return 'Заполните поле e-mail';
		elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
			return 'Неверная электронная почта!';
		elseif ($existing_email == $this->email)
			return 'Пользователь с таким e-mail уже существует!';
		return '';
	}

	public function validateRole()
	{
		if ($this->role < 1)
			return 'Укажите вашу роль в вузе';
	}

	public function validateFirstname()
	{
		if (empty($this->firstname))
			return 'Введите ваше имя';
	}
	public function validateSurname()
	{
		if (empty($this->surname))
			return 'Введите вашу фамилию';
	}
	public function validatePatronymic()
	{
		if (empty($this->patronymic))
			return 'Введите ваше очество';
	}
	public function validateDepartmentId()
	{
		if ($this->departmentId < 1)
			return 'Укажите вашу кафедру';
	}
	public function validateFacultyId()
	{
		if ($this->facultyId < 1)
			return 'Укажите ваш факультет';
	}

	public function validatePswd()
	{
		if (strlen($this->pswd_new) < 1)
			return 'Введите новый пароль';
		elseif (strlen($this->pswd_new) < 6)
			return 'Пароль должен содержать не меньше 6 символов!';

		// Код рабочий, временно отключен
		// elseif(!(preg_match('/[a-z]/', $this->pswd_new) &&
		// 	preg_match('/[A-Z]/', $this->pswd_new) &&
		// 	preg_match('/[0-9]/', $this->pswd_new)))
		// 	return 'Пароль должен содержать по одному из символов (a-z), (A-Z), (0-9)';
		elseif ($this->pswd_new != $this->pswd_conf)
			return 'Пароли не совпадают!';
		return '';
	}
}