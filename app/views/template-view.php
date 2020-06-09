<!DOCTYPE html>
<html>
<head>
	<title><?php echo $data['title'];?></title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/web/css/main.css">
	<?php
	if(!empty($data['styles']))
	{
		foreach($data['styles'] as $key => $value)
			echo "<link rel='stylesheet' type='text/css' href='/web/css/".$value."'>";
	}
	?>
</head>
<body>
	<header>
		<div class="container">
			<div class="logo">
				<a href="/"><img src="/web/img/icons/logo.png">Project</a>
			</div>
			<div class="pin">
				<?php 
				if(isset($_SESSION['user_id']))
				{
					echo "<a href=/profile class=button>".$data['user']->login."</a>";
					echo '<div class="popover">
							<a href=/subjects class=button>База знаний</a>';
						
					if (isset($data['user']) and $data['user']->role == 'Администратор')
						echo "<a href=http://localhost:8080/status_historylist.php class=button>Управление БД</a>";
					echo '<a href="/login/logout" class="button">Выход</a>';
					echo "</div>";
				}
				else
				{
					echo '<a href="/login" class="button">Вход ▼</a>
						<div class="popover">
							<a href="/signup" class="button">Регистрация</a>
						</div>';
				}
				?>
			</div>
		</div>	
	</header>
	<div class="container">
		<div class="document">
		 	<?php
				// Условие при котром side bar не выводится на страницах: Регистрация, Вход
			if ($data['title'] != 'Вход' && $data['title'] != 'Регистрация') {
		 	 	require_once 'app/views/side-bar-view.php';
			}
				?>
		 	<div class="main_content_block">
				<div class="header_of_content">
					<?php echo $data['title']; ?>
				</div>
				<div class="main_content">
					<?php require_once 'app/views/'.$data['content_view'];?>
				</div>
			</div>
	 	</div>
		
	</div>
	<?php
	if(!empty($data['scripts'])) {
		foreach($data['scripts'] as $key => $value)
			echo "<script src='/web/js/".$value."'></script>";
	}
	?>
</body>

</html>