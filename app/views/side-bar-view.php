<div class="side_bar">
	<div class="row">
		<a href="/forum">Форум</a>
		<div class="underline"></div>
	</div>
	<div class="row">
		<a href="#">Факультеты</a>
		<div class="underline"></div>
	</div>
	<div class="row">
		<a href="/searchuser">Поиск пользователя</a>
		<div class="underline"></div>
	</div>
	<?php
	if (isset($data['user']->role) and $data['user']->role == 'Студент')
		echo '<div class="row">
				<a href="/main/teacherList">Твои преподаватели</a>
				<div class="underline"></div>
			</div>';
	?>
</div>