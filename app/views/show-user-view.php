<div class="user_photo_block">
	<img src=<?php echo $data['avatar']; ?>>
	<div class="role">
		<?php 
		echo "<img class='icon' src='/web/img/icons/",$data['desired_user']->role,".jpeg'>";
		echo $data['desired_user']->role;
		?>
	</div>
</div>

<div class="user_data_block">
<!-- 	<div class="field">
		<div id="login">
			Логин: <?php //echo $data['desired_user']->login; ?>
		</div>
	</div> -->

	<div class="field">
		<div id="email">
			e-mail: <?php echo $data['desired_user']->email; ?>
		</div>
	</div>
</div>