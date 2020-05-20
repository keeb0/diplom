<div class="main_content_space">
	<form action="searchuser" method="POST">
		<label>Введите логин пользователя:
			<input type="text" name="desired_user_login">
		</label>
		<input class="buttons" type="submit" value="Поиск">
	</form>
	<div class="found_user_block">
		<?php 
		if (!empty($data['matching_users'])) {
			echo "Все найденные совпадения:";

			foreach ($data['matching_users'] as $value) {
				print "<a class='row' href='/profile/show_user?user_id=".$value['id']."'>".$value['login']."</a>";
			}
		}
		else
			print $data['error_message']
		?>
	</div>
</div>