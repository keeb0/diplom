<?php
class ModelSignUp extends Model
{
	public function getGroups()
	{
		$result = self::$connection->query("
			SELECT *
			FROM groups");
		for ($i=0; $i < $result->num_rows; $i++)
			$groups[] = $result->fetch_assoc();
		return $groups;
	}
}