<?php
class ModelSearchUser extends Model
{
	public function search($desired_user_data)
	{
		$desired_user_data .= '%';

		$stmt = self::$connection->prepare("
			SELECT login, id
			FROM users
			WHERE login LIKE ?");
		$stmt->bind_param('s', $desired_user_data);
		$stmt->execute();
		$result_set = $stmt->get_result();
		$amount_of_users = $result_set->num_rows;
		self::$connection->close();

		for($i = 0; $i < $amount_of_users; $i++)
			$matching_users[$i] = $result_set->fetch_assoc();

		if(!empty($matching_users))
			return $matching_users;

		$this->error_message = 'Не найдено совпадений по вашему запросу';
	}
}