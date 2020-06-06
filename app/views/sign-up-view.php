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
		<?php print $data['error_message']['firstname'];?>
	</div>
	<div class="row">
		<label for="surnameId">Фамилия:</label> 
		<input class="field" type="text" name="surname" id="surnameId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['surname'];?>
	</div>
	<div class="row">
		<label for="patronymicId">Очество:</label> 
		<input class="field" type="text" name="patronymic" id="patronymicId">
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['patronymic'];?>
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
		<select name="subjectId" onchange="setOption('facultyId', 'departmentId')" id="facultyId">
			<?php
			foreach ($data['faculties'] as $key => $value) {
				if ($value['id'] != 0) {
					echo "<option value=".$value['id'].">";
						echo $value['name'];
					echo "</option>";
				}
			}
			?>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['faculty'];?>
	</div>
	<div class="row">
		<label>Кафедра</label>
		<select name="department" id="departmentId">
			<option>Выберите факультет</option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['department'];?>
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
<?php
echo "<div class='data' hidden id='departmentsId'>";
foreach ($data['departments'] as $key => $value) {
	if ($key == 1)
		continue;
	echo "<id>";
		echo $value['id'];
	echo "</id><name>";
		echo $value['name'];
	echo "</name><facultyId>";
		echo $value['facultyId'];
	echo "</facultyId>";
}
echo "</div>";

echo "<div class='data2'  id='departmentsId'>";
foreach ($data['groups'] as $key => $value) {
	echo "<id>";
		echo $value['id'];
	echo "</id><name>";
		echo $value['name'];
	echo "</name><departmentId>";
		echo $value['departmentId'];
	echo "</departmentId>";
}
echo "</div>";
?>
<script type="text/javascript">
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

	function setOption(mainSelect, changedSelecet)
	{
		count = document.getElementById('changedSelecet').getElementsByTagName('id').length
		facultyIndex = document.getElementById(mainSelect).options.selectedIndex
		departmentObj = document.getElementById(changedSelecet)

		departmentObj.length = 0

		// if (facultyIndex != 0) {
			if (facultyIndex == 0)
				departmentObj[0] = new Option('Выберите факультет', -1)

			else {
				departmentObj[0] = new Option('пусто', -1)
			
				for (i = 0, j = 1; i < departments_amount; i++) {
					if (facultyIndex == departments[i].facultyId) {
						departmentObj[j] = new Option(departments[i].name, departments[i].id)
						j++
					}
				}
			}
	}
</script>