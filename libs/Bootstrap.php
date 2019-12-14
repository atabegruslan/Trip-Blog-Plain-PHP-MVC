<?php

class Bootstrap {

	public function __construct() 
	{
		self::setup_constants();
		self::setup_routes();
	}

	private function setup_constants()
	{
		$configFile = file_get_contents(getcwd().'/.config');
		$rows = explode("\n", $configFile);
		foreach ($rows as $row => $data) {
		    $row_data = explode('=', $data);
		    define(trim($row_data[0]), trim($row_data[1]) );
		}

		define('DS', '/');
		define('APP_NAME', 'trip_blog');
		define('APP_NAME_DISPLAY', 'Trip Blog');

		if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
			define('APP_FOLDER', APP_FOLDER_DEV);
		} else {
			define('APP_FOLDER', APP_FOLDER_PROD);
		}

		$_SERVER['REQUEST_SCHEME'] = $_SERVER['REQUEST_SCHEME'] ? $_SERVER['REQUEST_SCHEME'] : 'http';
		define('BASE_URL', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].DS.APP_FOLDER.DS.APP_NAME.DS);

		define('CSS_URL', BASE_URL.'public/css'.DS);
		define('JS_URL', BASE_URL.'public/js'.DS);
		define('IMAGES_URL', BASE_URL.'public/uploads'.DS);
		define('SYS_IMAGES_URL', BASE_URL.'public/images'.DS);

		define('ROOT_DIR', getcwd().DS);
		define('UPLOADS_DIR', ROOT_DIR.'public/uploads'.DS);
		define('VIEWS_DIR', ROOT_DIR.'views'.DS);

		define("IMG_RAD", 800);

		if (strpos(BASE_URL, 'localhost') !== false) {
			define('DB_NAME', DB_DEV);
			define('DB_USER', DB_DEV_USER);
			define('DB_PASS', DB_DEV_PASS);
		} else {
			define('DB_NAME', DB_PROD);
			define('DB_USER', DB_PROD_USER);
			define('DB_PASS', DB_PROD_PASS);
		}

	}

	private function setup_routes()
	{
		// possible incoming URLs:
		// - http://url.domain/
		// - http://url.domain/controller/
		// - http://url.domain/controller/action/
		// - http://url.domain/controller/action/parameters


		// Case: http://url.domain/
		$url = isset($_GET['url']) ? $_GET['url'] : null;

		$url = rtrim($url, '/'); // Case: http://url.domain/controller///////
		$url = explode('/', $url);

		$controllerName		= empty( $url[0] ) 	? 'index'		: $url[0];
		$action 			= empty( $url[1] ) 	? 'index' 		: $url[1];
		$parameters 		= empty( $url[2] ) 	? array() 		: array_slice($url, 2);

		if ( !file_exists( 'controllers/'.$controllerName.'.php' ) ) {
			new Errors('Controller unfound');
			return false;			
		}

		$controller = new $controllerName;
		$controller->loadModel( $controllerName );

		if ( !method_exists($controller, $action) ) {
			new Errors('Action unfound');
			return false;
		}

		$controller->{$action}( $parameters );

	}
}

?>