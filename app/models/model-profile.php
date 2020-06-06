<?php
class ModelUserAvatar extends ModelImage
{
	public $path_change;
	public $path_get;
	public $user;
	public $temp_name;

	const DEFAULT_AVATAR = '/web/user-photos/avatars/default-avatar/avatar.png';

	public function __construct($user_data)
	{
		parent::__construct();

		$this->user = clone $user_data;
		$this->path_change = 'web/user-photos/avatars/avatar-'.$this->user->user_id.'/';
		$this->path_get = '/'.$this->path_change;
	}

	public function getAvatar()
	{
		// Указываем путь к существующей аватарке иначе к дефолтному аватару всех пользователей
		if (!empty($this->user->avatar_name))
			$this->path_get .= $this->user->avatar_name;
		else
			$this->path_get = self::DEFAULT_AVATAR;
	}

	public function upload($image_data)
	{
		// Создаём директорию аватарки если таковой нет
		if (!file_exists($this->path_change))
			mkdir($this->path_change);

		// Задаем хэш имя аватарке
		$this->temp_name = uniqid();

		$success_upload = $this->uploadImage($image_data, $this->temp_name, $this->path_change);

		if ($success_upload) {
			// Запись нового имени аватара в БД
			$this->temp_name .= '.'.$this->image_type; // image_type - свойство родителя
			$this->updateAvatarName($this->temp_name, $this->user->user_id);

			// Удаление старой аватарки если она существует
			if (!empty($this->user->avatar_name))
				unlink($this->path_change.$this->user->avatar_name);

			// Обновляем страницу
			header("Location: /profile");
		}
		else
			return 'Вы отправили файл недопустимого типа (поддерживаемые файлы: PNG, JPEG, GIF)';
	}

	public function remove()
	{
		$this->updateAvatarName(NULL, $this->user->user_id);
		unlink($this->path_change.$this->user->avatar_name);
		header("Location: /profile");
	}

	function updateAvatarName($avatar_name, $id)
	{
		$stmt = self::$connection->prepare("
			UPDATE users
			SET avatar_name = ?
			WHERE id = ?
		");
		$stmt->bind_param('si', $avatar_name,  $id);
		$stmt->execute();
	}
}

class ModelShowDocs extends Model
{
	public function getSubjects($facultyId, $departmentId)
	{
		$stmt = self::$connection->prepare("
			SELECT id, name
			FROM subjects
			WHERE facultyId = ? AND departmentId = ?
		");
		$stmt->bind_param('ii', $facultyId, $departmentId);
		$stmt->execute();
		$result = $stmt->get_result();
		for ($i=0; $i < $result->num_rows; $i++) { 
			$rows[] = $result->fetch_assoc();
		}
// print_r($rows);
		return $rows;
	}
}