<?php
if (isset($_COOKIE['success_publish']))
	echo "<div class='message'>Новость успешно опубликована!</div>";
else {
?>
<div class="template_form">
	<form action="publish_news" method="post">
		<div class="row">
			<label>Заголовок</label>
			<input type="text" name="title">
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['title'])) echo $data['error_message']['title']; ?>
		</div>
		<div class="row">
			<label>Факультет</label>
			<select name="faculty" onchange="setOption()" id="facultyId">
				<?php
				foreach ($data['faculties'] as $key => $value) {
					echo "<option value='".$data['faculties'][$key]['id']."'>".$data['faculties'][$key]['name']."</oprion>";
				}
				?>
			</select>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['faculty'])) echo $data['error_message']['faculty']; ?>
		</div>
		<div class="row">
			<label>Кафедра</label>
			<select name="department" id="departmentId">
				<option>Выберите факультет</option>
			</select>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['department'])) echo $data['error_message']['department']; ?>
		</div>
		<div class="row">
			<textarea name="text" wrap="off" rows="20" cols="115" placeholder="Текст"></textarea>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['text'])) echo $data['error_message']['text']; ?>
		</div>
		<div class="row">
			<input type="submit" value="Опубликовать" class="buttons">
		</div>
	</form>
</div>
<?php
}
echo "<div class='data' hidden id='departmentsId'>";
foreach ($data['departments'] as $key => $value) {
	echo "<id>";
		echo $data['departments'][$key]['id'];
	echo "</id><name>";
		echo $data['departments'][$key]['name'];
	echo "</name><facultyId>";
		echo $data['departments'][$key]['facultyId'];
	echo "</facultyId>";
}
echo "</div>";
?>
<script type="text/javascript" defer>
	departments_amount = document.getElementById('departmentsId').getElementsByTagName('id').length
	departments = new Array()
	all_departments = document.getElementById('departmentsId')

	for (i = 0; i < departments_amount; i++) {
		departments.push({
			'id': all_departments.getElementsByTagName('id')[i].innerHTML,
			'name': all_departments.getElementsByTagName('name')[i].innerHTML,
			'facultyId': all_departments.getElementsByTagName('facultyId')[i].innerHTML
			})
	}

	function setOption()
	{
		departmentObj = document.getElementById('departmentId')
		facultyIndex = document.getElementById('facultyId').options.selectedIndex - 1

		departmentObj.length = 0

		if (facultyIndex != 0) {
			if (facultyIndex == -1)
				departmentObj[0] = new Option('Выберите факультет', -1)
			
			departmentObj[0] = new Option('пусто', -1)
			departmentObj[1] = new Option('для всего факультета', 0)
			
			for (i = 0, j = 2; i < departments_amount; i++) {
				if (facultyIndex == departments[i].facultyId) {
					departmentObj[j] = new Option(departments[i].name, departments[i].id)
					j++
				}
			}
		}
		else 
			departmentObj[0] = new Option('', 0)
	}
</script>