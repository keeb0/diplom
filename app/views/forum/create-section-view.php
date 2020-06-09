<?php
if (isset($_COOKIE['success_create']))
	echo "<span class='message'>Секция успешно создана!</span>";
else {
?>
<div class="template_form">
	<form action="createSection" method="post">
		<div class="row">
			<label>Название</label>
			<input type="text" name="name" required>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['name'])) echo $data['error_message']['name']; ?>
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
		<!-- <div class="row">
			<label>Кафедра</label>
			<select name="department" id="departmentId">
				<option>Выберите факультет</option>
			</select>
		</div> -->
		<!-- <div class="row error_message"> -->
			<?php// if (!empty($data['error_message']['department'])) echo $data['error_message']['department']; ?>
		<!-- </div> -->
		<!-- <div class="row">
			<textarea name="text" wrap="off" rows="20" cols="115" placeholder="Текст"></textarea>
		</div>
		<div class="row error_message"> -->
			<?php //if (!empty($data['error_message']['text'])) echo $data['error_message']['text']; ?>
		<!-- </div> -->
		<div class="row">
			<input type="submit" value="Опубликовать">
		</div>
	</form>
</div>
<?php
}