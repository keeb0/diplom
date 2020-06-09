<div class="side_bar">
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
	if (isset($data['user'])) {
		if ($data['user']->role == 'Преподаватель' or $data['user']->role == 'Студент')
			echo "<div class=row>
					<a href=/onlineLessons>Онлайн лекции</a>
					<div class=underline></div>
				</div>";
		if ($data['user']->role == 'Администратор') {
			echo "<div class=row>
				<a href=http://localhost:8080/status_historylist.php>Управление БД</a>
				<div class=underline></div>
			</div>";
		}
	}
	?>
</div>