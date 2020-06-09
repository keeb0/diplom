<div class="main_content_space">
	<form action="searchuser" method="POST">
		<label>Введите логин пользователя:
			<input type="text" name="desired_user_login">
		</label>
		<input class="buttons" type="submit" value="Поиск">
	</form>
	<div class="found_template_block">
		<?php 
		if (isset($data['matching_users']) and !empty($data['matching_users'])) {
			echo "<p>Все найденные совпадения:</p>";

			foreach ($data['matching_users'] as $value) {
				print "<a class='row' href='/profile/show_user?user_id=".$value['id']."'>".$value['login']."</a>";
				print '<div class="underline"></div>';
			}
		}
		elseif (!empty($data['error_message']['user']))
			print $data['error_message']['user'];
		?>
	</div>
</div>