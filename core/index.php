<?php

use Project\Helpers\Config;

require 'app/Config.php';
require 'app/Database.php';
require 'altorouter/AltoRouter.php';


//get config
$configx = new Config();
$configx->loadConfigFile('config.php');

//connect to the forumss
require 'app/PhpBBSession.php';

//connect to database
$database = new Database( $configx->get('db.host'), $configx->get('db.user'), $configx->get('db.pass'), $configx->get('db.name') );

//set altorouter
$router = new AltoRouter();
$router->setBasePath( $configx->get('espionage.core_path') );

//set routes
$router->map('GET|POST','/', 'home#index', 'home');
$router->map('GET','/config', 'config', 'config');
$router->map('GET','/poster/[i:round_id]', 'poster', 'poster');
$router->map('GET','/user', 'user', 'user');

/*
$router->map('GET','/users/', array('c' => 'UserController', 'a' => 'ListAction'));
$router->map('GET','/users/[i:id]', 'users#show', 'users_show');
$router->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
*/

//match current request
$request = $router->match();

?>

<!--
<h3>Current request: </h3>
<pre>
	Target: <?php /*var_dump($request['target']); */?>
    Params: <?php /*var_dump($request['params']); */?>
    Name: 	<?php /*var_dump($request['name']); */?>
</pre>-->

<?php

if( $request['target'] === 'config' )
    echo json_encode( $configx->get_raw() );
else if( $request['target'] === 'poster' )
    echo json_encode( $database->getPosterInformation( $request['params']['round_id'] ) );
else if( $request['target'] === 'user' )
    echo json_encode( $user->public_data );

?>