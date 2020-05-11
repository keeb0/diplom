<?php
define('CORE_DIR', 'core/');

require_once CORE_DIR.'controller.php';
require_once CORE_DIR.'model.php';
require_once CORE_DIR.'view.php';
require_once CORE_DIR.'model-image-upload.php';
require_once CORE_DIR.'model-user.php';
require_once CORE_DIR.'route.php';

Route::start();