<?php
class Model_Image extends Model
{
	// public $photos_main_path = '/web/user-photos';
	public $image_type;

	public function upload_image($image_data, $name, $path)
	{
		switch ($image_data['type']) {
			case 'image/png':
				$this->image_type = 'png';
				break;
			case 'image/jpeg':
				$this->image_type = 'jpeg';
				break;
			case 'image/gif':
				$this->image_type = 'gif';
				break;
			default:
				$this->image_type = '';
				break;
		}
		if ($this->image_type) {
			$image = new Imagick($image_data['tmp_name']);
			$image->thumbnailImage(250, 0);
			$image->writeImage($_SERVER['DOCUMENT_ROOT'].'/'.$path.'/'.$name.'.'.$this->image_type);
			// move_uploaded_file($image_data['tmp_name'], $path.'/'.$name.'.'.$this->image_type);
			return 1;
		}
		else
			return 0;
	}

	public function delete_image()
	{
		
	}
}