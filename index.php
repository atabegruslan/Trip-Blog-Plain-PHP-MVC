<?php 

require 'vendor/autoload.php';

spl_autoload_register('load');

function load($class)
{
    $class = str_replace(__NAMESPACE__ . '\\', __NAMESPACE__ . '/', $class); // Linux servers can't take forward slashes

    $dirs = array(
        'libs/', 
        'libs/PHPMailer/', 
        'libs/PHPMailer/class.', 
        'libs/Facebook/', 
        'controllers/', 
        'models/',
    );

    foreach ( $dirs as $dir ) 
    {
        if (file_exists($dir.$class.'.php')) 
        {
            require($dir.$class.'.php');

            return;
        } 
        else if ( file_exists( $dir. strtolower($class) .'.php' ) ) 
        { // Linux servers are case sensitive
            require( $dir. strtolower($class) .'.php' );

            return;            
        }
    }
}

$app = new Bootstrap();

?>
