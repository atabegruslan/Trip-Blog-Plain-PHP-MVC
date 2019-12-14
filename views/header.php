<!DOCTYPE html>
<html>
<head>
	<title><?php echo APP_NAME_DISPLAY; ?></title>
    <link rel="icon" href="<?php echo BASE_URL; ?>favicon.ico">
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>default.css?v=<?php echo rand(); ?>" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css?v=<?php echo rand(); ?>" rel="stylesheet">
</head>

<body>
	<div id="auth">
		<?php if ( isset($_SESSION['user_id']) ) : ?>

			<form action="<?php echo BASE_URL; ?>user/logout/" method="post">
			    <button>Logout</button>
			</form>

		<?php else : ?>

			<?php if ( strpos( $_SERVER['REQUEST_URI'], 'login') ) : ?>
				<button onclick="location.href = '<?php echo BASE_URL; ?>user/register/';">Register</button>
			<?php else : ?>
				<button onclick="location.href = '<?php echo BASE_URL; ?>user/login/';">Login</button>
			<?php endif; ?>

		<?php endif; ?>
	</div>
