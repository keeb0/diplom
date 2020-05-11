<div class="user_photo_block">
	<img src="<?php echo $data['avatar']; ?>">
	<form action="profile" method="post">
		<input class="remove buttons" type="submit" name="remove_confirm" value="Удалить аватар">
	</form>
	
	<form action="profile" method="post" enctype="multipart/form-data" class="new_photo_form">
		<label for="photo_new" class="new_photo_elements">
			Сменить фото пользователя
		</label>
		<input id="photo_new"  type="file" name="photo">
		<button class="buttons commit">Сохранить фото</button>
		<span class="error_message" id="error_message_avatar">
			<?php if(!empty($_FILES)) echo $data['error_message']; ''?>
		</span>
	</form>
</div>

<form method="post" action="profile" id="data_updating" enctype="multipart/form-data"></form>
<form method="post" action="profile" id="pwsd_updating" enctype="multipart/form-data"></form>
<div class="user_data_block">
	<div class="field">
		<div id="login">
			Логин: <?php echo $data['user']->login; ?>
			<button class="buttons" onclick="hide('login', 'login_edit', '', '', '')"> ✎ </button>
		</div>

		<div  hidden id='login_edit'>
			<label for="login_user">Логин:</label>
			<input name="login" type="text" form="data_updating" id="login_user" value="<?php echo $data['user']->login; ?>">
			<button class="buttons" onclick="hide('login_edit', 'login', 'login_user', '', '')"> ✖ </button>
		</div>
	</div>
	<div class="field error_message">
		<?php if(!empty($data['error_message']['login'])) echo $data['error_message']['login']; ?>
	</div>

	<div class="field">
		<div id="email">
			e-mail: <?php echo $data['user']->email; ?>
			<button class="buttons" onclick="hide('email', 'email_edit', '','', '')"> ✎ </button>
		</div>

		<div  hidden id='email_edit'>
			<label for="email_user">e-mail:</label>
			<input name="email" type="text" form="data_updating" id="email_user" value="<?php echo $data['user']->email; ?>">
			<button class="buttons" onclick="hide('email_edit', 'email', 'email_user', '', '')"> ✖ </button>
		</div>
	</div>
	<div class="field error_message">
		<?php if(!empty($data['error_message']['email'])) echo $data['error_message']['email']; ?>
	</div>
	<div class="field">
		<button  class="buttons commit" value="submit" form="data_updating">Сохранить данные</button>
	</div>

	<div hidden="" id="pswd">
		<div class="field">
			<label for="pswdOld_user">Текущий пароль: </label>
			<input name="pswd" type="password" form="pwsd_updating" id="pswdOld_user">
			<button class="buttons" onclick="hide('pswd', 'pswd_edit', 'pswdOld_user', 'pswdNew_user', 'pswdNew2_user')"> ✖ </button>
		</div>
		<div class="field">
			<label for="pswdNew_user">Новый пароль:</label>
			<input class="pswd_inputs" name="pswd_new" type="password" form="pwsd_updating" id="pswdNew_user">
		</div>
		<div class="field">
			<label for="pswdNew2_user">Подтвердите пароль:</label>
			<input class="pswd_inputs" name="pswd_conf" type="password" form="pwsd_updating" id="pswdNew2_user">
			
		</div>
	</div>

	<div id="pswd_edit">
		<div class="field">
			Изменить пароль <button class="buttons"  onclick="hide('pswd_edit', 'pswd', '','', '')"> ✎ </button>
		</div>
	</div>
	<div class="field error_message">
		<?php if(!empty($data['error_message']['pswd'])) echo $data['error_message']['pswd']; ?>
	</div>
	
	<div class="field">
		<button  class="buttons commit" value="submit" form="pwsd_updating">Сохранить пароль</button>
	</div>
	
</div>