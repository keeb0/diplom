<?php
if (!empty($data['documents'])) {
	foreach ($data['documents'] as $key => $value) {
		echo '<div class="template_form">';
			echo "<div class='row'>";
			echo "<div class='row'><b>".$value['title']."</b></div>";
			echo "<div class='row'>Автор ".$value['author']."</div>";
			// echo "<div class='row'>Кол-во страниц ".$value['pages']."</div>";
			// echo "<div class='row'>Год ".$value['year']."</div>";
			echo "<div class='row'>Описание ";
			echo "<p>".$value['description']."</p></div>";
			if (!empty($value['hashName']))
				echo '<a class="buttons download" href="/web/user/teacher-docs/teacher-'.$value['userId'].'/'.$value['hashName'].'">Скачать</a></div>';
			else
				echo '<a class="buttons download" href='.$value['altLink'].'>Скачать</a></div>';
			echo "<hr>";
		echo "</div>";
	}
}
?>