<form class="template_form" action="/subjects" method="post">
	<div class="row">
		<label>
			Укажите семестр нжуного вам предмета
			<input type="number" name="semester" min="1" max="20" size="10" required="">
		</label>
	</div>
	<div class="row error_message">
		<?php if (!empty($data['error_message']['semester'])) echo $data['error_message']['semester']; ?>
	</div>
	<div class="row">
		<input type="submit" class="buttons" value="Отобразить предметы">
	</div>
</form>
<?php
if (!empty($data['subjects'])) {
?>
<div class="found_template_block subjects_block">
	<?php 
	if (!empty($data['subjects'])) {
		foreach ($data['subjects'] as $value) {
			print "<a class='row' href='/subjects/docs?subject_id=".$value['id']."'>".$value['name']."</a>";
			print '<div class="underline"></div>';
		}
	}
	else
		print $data['error_message']
	?>
</div>
<?php
	}
?>