<div class="template_form">
	<form action="uploadDoc" method="post" enctype="multipart/form-data">
		<div class="row">
			<label>Название методички</label>
			<input type="text" name="title">
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['title']))
				echo $data['error_message']['title'];
			?>
		</div>
		<div class="row">
			<label>Методичка</label>
			<input type="file" name="document">
		</div>
		<div class="row">
			<label>Альтернативная ссылка</label>
			<input type="text" name="altLink">
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['altLink']))
				echo $data['error_message']['altLink'];
			?>
		</div>
		<div class="row">
			<label>Предметная область</label>
			<select id="subjects_option" name="subjectId">
				<!-- <option value="">нет</option> -->
			</select>
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['subjectId']))
				echo $data['error_message']['subjectId'];
			?>
		</div>
		<div class="row">
			<label>Краткое описание</label>
			<textarea name="description" rows="20" cols="110" wrap="hard"></textarea>
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['description']))
				echo $data['error_message']['description'];
			?>
		</div>
		<div class="row">
			<label>Автор методички</label>
			<input type="text" name="author">
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['author']))
				echo $data['error_message']['author'];
			?>
		</div>
		<div class="row">
			<label>Количество страниц</label>
			<input type="text" name="pages">
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['pages']))
				echo $data['error_message']['pages'];
			?>
		</div>
		<div class="row">
			<label>Год написания методчки</label>
			<input type="text" name="year">
		</div>
		<div class="row error_message">
			<?php
			if (!empty($data['error_message']['year']))
				echo $data['error_message']['year'];
			?>
		</div>
		<div class="row">
			<input type="submit" value="Загрузить">
		</div>
	</form>
</div>
<?php
echo "<div class='data' hidden id='subjects_data'>";
foreach ($data['subjects'] as $key => $value) {
	echo "<id>";
		echo $value['id'];
	echo "</id><name>";
		echo $value['name'];
	echo "</name>";
	// echo "<facultyId>";
		// echo $value['facultyId'];
	// echo "</facultyId>";
}
echo "</div>";