<?php
echo $data['button'];

echo '<div class="data" id="newsListId">';
for ($i = 0; $i < count($data['news']); $i++) {
	echo "<div class='news'>";
		echo "<div class='title'>".$data['news'][$i]['title']."</div>";
		echo "<div class='date'>".$data['news'][$i]['publicationDate']."</div>";
		echo "<div class='text'>".$data['news'][$i]['text']."</div>";
	echo "<hr class ='news_end'></div>";
}

// Вывод пагинации
if ($data['total_page'] > 1) {
	echo "<div class='pagination'>";
		echo $data['page_list']['pervpage'].$data['page_list']['page2left'].$data['page_list']['page1left'].'<a id="currentPage"><b>'.$data['page'].'</b></a>'.$data['page_list']['page1right'].$data['page_list']['page2right'].$data['page_list']['nextpage'];
	echo "</div>";
}
echo "</div>";
