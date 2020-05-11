<?php
class View
{
	public function generate($data)
	{
		require_once 'app/views/'.$data['template_view'];
	}
}