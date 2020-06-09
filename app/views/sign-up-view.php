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
		<select class="field" name="role" id="roleId" onchange="changeVisibility('roleId', 'ID_group_block', 2)">
			<option value="0">пусто</option>
			<option value="1">Преподаватель</option>
			<option value="2">Студент</option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['role'];?>
	</div>
	<div class="row">
		<label for="ID_faculty">Факультет</label> 
		<select name="faculty" onchange="setDepartmentsOption('ID_faculty', 'ID_department')" id="ID_faculty">
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
		<select name="department" id="ID_department" onchange="setGroupsOption()">
			<option>Укажите факультет</option>
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
	<div class="row" id="ID_group_block" style="visibility: hidden;">
		<label>Группа</label>
		<select name="group" id="ID_group">
			<option>Укажите группу</option>
		</select>
	</div>
	<div class="row error_message">
		<?php print $data['error_message']['group'];?>
	</div>
	<div class="row">
		<input class="buttons" type="submit" value="Зарегистрироваться">
	</div>
</form>
<?php
echo "<div class='data' hidden id='ID_departments'>";
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

echo "<div class='data' hidden id='ID_groups'>";
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
	departments = new Array()
	all_departments = document.getElementById('ID_departments')
	departments_amount = all_departments.getElementsByTagName('id').length

	groups = new Array()
	all_groups = document.getElementById('ID_groups')
	groups_amount = all_groups.getElementsByTagName('id').length

	for (i = 0; i < groups_amount; i++) {
		groups.push({
			'id': all_groups.getElementsByTagName('id')[i].innerHTML,
			'name': all_groups.getElementsByTagName('name')[i].innerHTML,
			'departmentId': all_groups.getElementsByTagName('departmentId')[i].innerHTML
			})
	}

	for (i = 0; i < departments_amount; i++) {
		departments.push({
			'id': all_departments.getElementsByTagName('id')[i].innerHTML,
			'name': all_departments.getElementsByTagName('name')[i].innerHTML,
			'facultyId': all_departments.getElementsByTagName('facultyId')[i].innerHTML
			})
	}

	function setDepartmentsOption(mainSelect, changedSelecet)
	{
		facultyIndex = document.getElementById(mainSelect).options.selectedIndex
		departmentObj = document.getElementById(changedSelecet)

		departmentObj.length = 0

		if (facultyIndex == 0)
			departmentObj[0] = new Option('Укажите факультет', -1)

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

	function setGroupsOption()
	{
		departmentIndex = document.getElementById('ID_department').options.selectedIndex
		groupObj = document.getElementById('ID_group')

		groupObj.length = 0
		groupObj[0] = new Option('Укажите группу', 0)
	
		for (i = 0, j = 1; i < groups_amount; i++) {
			if (departmentIndex == groups[i].departmentId) {
				groupObj[j] = new Option(groups[i].name, groups[i].id)
				j++
			}
		}
	}

	function changeVisibility(mainObj, changedObj, index)
	{
		mainIndex = document.getElementById(mainObj).options.selectedIndex
		changedObj = document.getElementById(changedObj)
		
		if (mainIndex == index) {
			changedObj.style.visibility = 'visible';
		}
		else
			changedObj.style.visibility = 'hidden';
	}	
</script>