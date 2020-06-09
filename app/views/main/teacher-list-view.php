<div class="main_content_space">
	<div class="found_template_block">
		<?php 
		if (!empty($data['teachers'])) {
			foreach ($data['teachers'] as $value) {
				print "<a class='row' href='/profile/show_user?user_id=".$value['id']."'>".$value['fullname']."</a>";
				print '<div class="underline"></div>';
			}
		}
		else
			print $data['error_message']
		?>
	</div>
</div>