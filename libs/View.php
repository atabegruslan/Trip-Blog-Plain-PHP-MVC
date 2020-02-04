<?php

class View 
{
	public function __construct() 
	{

	}

	public function render($name)
	{
		$twig = get_twig();

		$data = [
			'data'       => isset($this->data) ? $this->data : null,
			'msg'        => isset($this->msg) ? $this->msg : null,
			'viewsDir'   => VIEWS_DIR,
			'baseUrl'    => BASE_URL,
			'cssUrl'     => CSS_URL,
			'jsUrl'      => JS_URL,
			'sysImgUrl'  => SYS_IMAGES_URL,
			'userId'     => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
			'requestUrl' => $_SERVER['REQUEST_URI'],
			'appTitle'   => APP_NAME_DISPLAY,
		];

		echo $twig->render($name . '.html', ['data' => $data]);
	}
}

?>
