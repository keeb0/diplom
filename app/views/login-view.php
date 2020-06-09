<form class="login_block" action="login" method="post">
	<div class="row">
		<label for="user_login">Логин:</label>
		<input class="field" type="text" name="login" id="user_login">
	</div>

	<div class="row">
		<label for="user_pswd">Пароль:</label>
		<input class="field" type="password" name="pswd" id="user_pswd">
	</div>
	
	<div class="row">
		<input class="buttons" type="submit" name="submit" value="Войти">
		<a href="signup">Регистрация</a>
	</div>

	<div class="row error_message">
		<?php !empty($data) ? print $data['error_message'] : ""; ?>
	</div>
</form>