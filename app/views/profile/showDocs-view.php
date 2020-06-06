<form class="subjects" <?php echo 'action=showDocs?user_id='.$_GET['user_id'];?> method="post">
	<select name="subjectId">
		<?php
		foreach ($data['subjects'] as $key => $value) {
			echo "<option value=".$value['id'].">";
				echo $value['name'];
			echo "</option>";
		}
		?>
	</select>
	<input type="submit" value="Выбрать">
</form>

<?php
if (!empty($data['documents'])) {

	// echo "<table class='teacherDocs' border='1'>";
	// 	echo '<tr">';

		// 
		
		// echo "</tr>";
	foreach ($data['documents'] as $key => $value) {
		echo '<div class="publishing_news">';
			echo "<div class='row'>";
			echo "<div class='row'><b>".$value['title']."</b></div>";
			echo "<div class='row'>Автор ".$value['author']."</div>";
			// echo "<div class='row'>Кол-во страниц ".$value['pages']."</div>";
			// echo "<div class='row'>Год ".$value['year']."</div>";
			echo "<div class='row'>Описание ";
			echo "<p>".$value['description']."</p></div>";
			if (!empty($value['hashName']))
				echo '<a class="buttons download" href="/web/user/teacher-docs/teacher-'.$_GET['user_id'].'/'.$value['hashName'].'">Скачать</a></div>';
			else
				echo '<a class="buttons download" href='.$value['altLink'].'>Скачать</a></div>';
			echo "<hr>";
		echo "</div>";
				// .$value['author'];
				// .;
				// .;
			// echo "</tr>";
		// echo '<div class="row">';
		// echo $value['description'];
		// echo "</div>";
	}

		// echo "</table>";
}
?>
<style type="text/css">
	.teacherDdiv{
		padding: 6px;
	}
	.teacherDocs {
		border-collapse: collapse;
	}
</style>