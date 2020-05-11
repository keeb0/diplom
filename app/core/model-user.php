<?php
class Model_User extends Model
{
	public $user_id;
	public $login;
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
			SELECT login, email, avatar_name, role
			FROM users 
			WHERE id = '$this->user_id'
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
		$successful_validate = true;
		// Указан не корректный id -1 (пользователь еще не создан)
		$existing_user = $this->getExistingUser(-1);
		$error_message['login'] = $this->validateLogin($existing_user['login']);
		$error_message['email'] = $this->validateEmail($existing_user['email']);
		$error_message['pswd'] = $this->validatePswd();

		foreach ($error_message as $key => $value) {
				if(!empty($value))
				{
					$successful_validate = 0;
					break;
				}
			}
		
		if ($successful_validate) {
			$this->pswd_new = password_hash($this->pswd_new, PASSWORD_DEFAULT);
			$stmt = self::$connection->prepare("
				INSERT INTO users (id, login, email, password) 
				VALUES (NULL , ?, ?, ?)
				");
			$stmt->bind_param('sss', $this->login, $this->email, $this->pswd_new);
			$stmt->execute();

			$_SESSION['user_id'] = self::$connection->insert_id;
			setcookie('checkIn', true, time() + 3);
			return 1;
		}
		else
			return $error_message;
	}

	// Редактирование данных пользователем
	public function editData($user_id)
	{
		$successful_validate = 1;

		$existing_user = $this->getExistingUser($user_id);
		$error_message['login'] = $this->validateLogin($existing_user['login']);
		$error_message['email'] = $this->validateEmail($existing_user['email']);

		foreach ($error_message as $key => $value) {
			if(!empty($value))
			{
				$successful_validate = 0;
				break;
			}
		}
	
		if ($successful_validate) {
			foreach ($this as $key => $value)
			{
				if (!empty($value) && $key != 'data_updating') {
					$stmt = self::$connection->prepare("UPDATE users SET $key = ? WHERE id = '$user_id'");
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
		if (empty($error_message['pswd'])) {
			$this->pswd_new = password_hash($this->pswd_new, PASSWORD_DEFAULT);
			$stmt = self::$connection->prepare("UPDATE users SET password = ? WHERE id = '$user_id'");
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
			SELECT id, role, password
				AS 'hash'
			FROM users
			WHERE login = ?
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

	public function validateLogin($login)
	{
		if ($this->login == '')
			return' Заполните поле логин';
		elseif (preg_match('/\W/', $this->login))
			return 'Логин может включать латинские буквы (a-z), цифры (0-9) и знак _';
		elseif ($login == $this->login)
			return 'Пользователь с таким логином уже существует!';
	}

	public function validateEmail($email)
	{
		if ($this->email == '')
			return 'Заполните поле e-mail';
		elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
			return 'Неверная электронная почта!';
		elseif ($email == $this->email)
			return 'Пользователь с таким e-mail уже существует!';
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