<?php 

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\GraphUser;

class Social extends Controller {

	public function __construct() 
	{
		parent::__construct();
	}

	public function signin($args) 
	{
		$means = $args[0];

		switch ($means) {
		    case 'facebook':
		        $this->facebookSignin();
		        break;

		    default:
	            new Errors('Wrong third-party signin means');
	            return false;  
		}
	}

	public function facebookSignin()
	{
		session_start();

		// init app with app id and secret
		FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);

		// login helper with redirect_uri
		$helper = new FacebookRedirectLoginHelper(FB_REDIRECT_URL);

		try {
			$sess = $helper->getSessionFromRedirect();
		}catch( FacebookRequestException $ex ) {
			// When Facebook returns an error
			var_dump($ex);
		}catch( Exception $ex ) {
			// When validation fails or other local issues
			var_dump($ex);
		}

		if(isset($_SESSION['fb_token'])){
		    $sess = new FacebookSession($_SESSION['fb_token']);
		}

		// see if we have a session
		if(isset($sess)){
			$_SESSION['fb_token'] = $sess->getToken();  

			// graph api request for user data
			$request = new FacebookRequest($sess, 'GET', '/me?fields=id,name,email');
			$response = $request->execute();

			// get response
			$graphObject = $response->getGraphObject(GraphUser::className());
			$type = 'facebook';
			$this->saveIfNew($graphObject, $type);

			//$image = 'https://graph.facebook.com/'.$fbid.'/picture?width=200';
			//echo "<img src='$image' />";
		}else{
			$loginUrl = $helper->getLoginUrl(array(
				'scope' => 'email'
			));
			header("Location: ".$loginUrl);
		}
	}

	public function saveIfNew($graphObject, $type)
	{   
		$hash = new Hash();

		$socialUser = array(
		    'sid' => $graphObject->getProperty('id'),
		    'email' => $graphObject->getProperty('email'),
		    'password' => $hash->create('sha256', $graphObject->getProperty('id'), HASH_PASSWORD_KEY), // fix later
		    'name' => $graphObject->getProperty('name'),
		    'type' => $type
		);

		$user = $this->model->read($socialUser['email'], $socialUser['type']);

		if (empty($user)) { // user havent been here before via fb
			$this->model->create($socialUser);
		}

		$user = $this->model->read($socialUser['email'], $socialUser['type']);
		$_SESSION['user_id'] = $user['id'];
		header('location: ' . BASE_URL . 'entry');
	}

}

?>