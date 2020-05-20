<?php
class Route 
{
	public function start()
	{
		$controller_name = 'Main';
		$action_name = 'index';

		$routes = explode('?', $_SERVER['REQUEST_URI']);
		// $get = $routes[1];
		$routes = explode('/', $routes[0]);

		!empty($routes[1]) ? $controller_name = $routes[1] : 0;

		!empty($routes[2]) ? $action_name = $routes[2] : 0;

		$model_name = 'Model_'.$controller_name;

		$model_file = 'model-'.strtolower($controller_name).'.php';
		$model_path = 'app/models/'.$model_file;
		file_exists($model_path) ? require_once $model_path : 0;

		$controller_file = 'controller-'.strtolower($controller_name).'.php';
		$controller_path = 'app/controllers/'.$controller_file;
		
		if(file_exists($controller_path))
		{
			require_once $controller_path;
		}
		else
		{
			Route::error_404();
			return 0;
		}
		
		// Меняем в имени контроллера '-' на '_', т.к. в файле прописан '-', а в имени класса контроллера '_'
		$controller_name_exp = explode('-', $controller_name);

		if(isset($controller_name_exp[1]))
		{
			$controller_name = '';
			$gaps = count($controller_name_exp);
			for($i = 0; $i < $gaps; $i++)
			{
				if($i > 0)
					$controller_name .= '_';

				$controller_name .= $controller_name_exp[$i];
			}
		}

		$controller_name = 'Controller'.$controller_name;
		$action_name = 'action_'.$action_name;
		
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
			$controller->$action();
		else
			Route::error_404();
	}

	public function error_404()
	{
		require_once 'app/controllers/controller-404.php';

		$controller = new Controller404;
		$controller->action_index();
	}

}