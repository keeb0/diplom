<?php
if ($data['title'] == 'Главная') {; 
?>
<div class="news_list">
	<div class="news">
		<div class="title">Название новости</div>
		<div class="date">2020-05-15 10:10:10</div>
		<div class="text">
			Must you with him from him her were more. In eldest be it result should remark vanity square. Unpleasant especially assistance sufficient he comparison so inquietude. Branch one shy edward stairs turned has law wonder horses. Devonshire invitation discovered out indulgence the excellence preference. Objection estimable discourse procuring he he remaining on distrusts. Simplicity affronting inquietude for now sympathize age. She meant new their sex could defer child. An lose at quit to life do dull. 
		</div>
	</div>
	<div class="news">
		<div class="title">Название новости2</div>
		<div class="date">2020-05-15 12:10:10</div>
		<div class="text">
			Must you with him from him her were more. In eldest be it result should remark vanity square. Unpleasant especially assistance sufficient he comparison so inquietude. Branch one shy edward stairs turned has law wonder horses. Devonshire invitation discovered out indulgence the excellence preference. Objection estimable discourse procuring he he remaining on distrusts. Simplicity affronting inquietude for now sympathize age. She meant new their sex could defer child. An lose at quit to life do dull. 
		</div>
	</div>
	<div class="news">
		<div class="title">Название новости3</div>
		<div class="date">2020-05-15 11:10:10</div>
		<div class="text">
			Must you with him from him her were more. In eldest be it result should remark vanity square. Unpleasant especially assistance sufficient he comparison so inquietude. Branch one shy edward stairs turned has law wonder horses. Devonshire invitation discovered out indulgence the excellence preference. Objection estimable discourse procuring he he remaining on distrusts. Simplicity affronting inquietude for now sympathize age. She meant new their sex could defer child. An lose at quit to life do dull. 
		</div>
	</div>
</div>
<?php
}
if ($data['title'] == 'Публикация новости') {
?>
<div class="publishing_news">
	<form action="publish_news" method="post">
		<div class="row">
			<label>Название</label>
			<input type="text" name="title">
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['title'])) echo $data['error_message']['title']; ?>
		</div>
		<div class="row">
			<label>Факультет</label>
			<select name="facultyId">
				<?php
				foreach ($data['faculties'] as $key => $value) {
					echo "<option value='".$data['faculties'][$key]['id']."'>".$data['faculties'][$key]['name']."</oprion>";
				}
				?>
			</select>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['facultyId'])) echo $data['error_message']['facultyId']; ?>
		</div>
		<div class="row">
			<label>Кафедра</label>
			<select name="departmentId">
				<?php
				foreach ($data['departments'] as $key => $value) {
					echo "<option value='".$data['departments'][$key]['id']."'>".$data['departments'][$key]['name']."</oprion>";
				}
				?>
			</select>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['departmentId'])) echo $data['error_message']['departmentId']; ?>
		</div>
		<div class="row">
			<textarea name="text" wrap="off" rows="20" cols="115" placeholder="Текст"></textarea>
		</div>
		<div class="row error_message">
			<?php if (!empty($data['error_message']['text'])) echo $data['error_message']['text']; ?>
		</div>
		<div class="row">
			<input type="submit" value="Опубликовать">
		</div>
	</form>
</div>
<?php
}