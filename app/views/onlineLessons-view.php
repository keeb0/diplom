<button class="buttons"  onclick="startLection()">Начать лекцию</button>
<?php
if ($data['user']->role == 'Преподаватель') {
?>
<script type="text/javascript">
	
	request = new XMLHttpRequest;

	request.open('POST','exec/startLesson.php', true)
	// Обязательныйы заголовок при работе с POST
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

	request.onreadystatechange = function()
	{
		if (this.readyState == 4) {
			if (this.status == 200) {
				// window.location.href = "http://localhost"
			}
		}
	}
	// window.location.href = "http://localhost?admin=true"
	request.send('title=')
	
</script>
<p>Загрузка...</p>
<?php
}
if ($data['user']->role != 'Преподаватель') {
	header('location: http://localhost');
}