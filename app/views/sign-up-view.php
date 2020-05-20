<form class="sign_up_block" action="signup" method="post">
	<div class="row">
		<label for="loginId" >Логин:</label> 
		<input class="field" type="text" name="login" id="loginId" value="saddsa">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['login'];?>
	</div>
	<div class="row">
		<label for="firstnameId">Имя:</label> 
		<input class="field" type="text" name="firstname" id="firstnameId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['email'];?>
	</div>
	<div class="row">
		<label for="surnameId">Фамилия:</label> 
		<input class="field" type="text" name="surname" id="surnameId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['email'];?>
	</div>
	<div class="row">
		<label for="patronymicId">Очество:</label> 
		<input class="field" type="text" name="patronymic" id="patronymicId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['email'];?>
	</div>
	<div class="row">
		<label for="emailId">e-mail:</label> 
		<input class="field" type="text" name="email" id="emailId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['email'];?>
	</div>
	<div class="row">
		<label for="roleId">Ваша роль в вузе</label> 
		<select class="field" name="role" id="roleId">
			<option value="0">пусто</option>
			<option value="1">Преподаватель</option>
			<option value="2">Студент</option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['role'];?>
	</div>
	<div class="row">
		<label for="facultyId">Факультет</label> 
		<select class="field" name="faculty" id="facultyId">
			<option value="0">пусто</option>
			<option value="1">Информационные технологии</option>
			<option value="2"></option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['role'];?>
	</div>
	<div class="row">
		<label for="departmentId">Кафедра</label> 
		<select class="field" name="department" id="departmentId">
			<option value="0">пусто</option>
			<option value="1">Автоматическое управление</option>
			<option value="2"></option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['role'];?>
	</div>
	<div class="row">
		<label for="pswdId">Пароль:</label>
		<input class="field" type="password" name="pswd_new" id="pswdId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['pswd'];?>
	</div>
	<div class="row">
	<div class="row">
		<label for="pswdConfId">Подтвердите пароль:</label>
		<input class="field" type="password" name="pswd_conf" id="pswdConfId">
	</div>
	<div class="row">
		<input class="buttons" type="submit" value="Зарегистрироваться">
	</div>
</form>