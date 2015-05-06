<?php

use Project\Helpers\Config;

require 'app/Config.php';
require 'app/Database.php';
require 'altorouter/AltoRouter.php';


//get config
$config = new Config();
$config->loadConfigFile('config.php');

//connect to database
$database = new Database( $config->get('db.host'), $config->get('db.user'), $config->get('db.pass'), $config->get('db.name') );


//set altorouter
$router = new AltoRouter();
$router->setBasePath( $config->get('espionage.path') );

//set routes
$router->map('GET|POST','/', 'home#index', 'home');
$router->map('GET','/config', 'config', 'config');
$router->map('GET','/poster/[i:round_id]', 'poster', 'poster');

/*
$router->map('GET','/users/', array('c' => 'UserController', 'a' => 'ListAction'));
$router->map('GET','/users/[i:id]', 'users#show', 'users_show');
$router->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
*/

//match current request
$request = $router->match();

?>

<h3>Current request: </h3>
<pre>
	Target: <?php var_dump($request['target']); ?>
    Params: <?php var_dump($request['params']); ?>
    Name: 	<?php var_dump($request['name']); ?>
</pre>

<?php

if(  $request['target'] === 'config' )
    echo json_encode( $config->get_raw() );
if(  $request['target'] === 'poster' )
    echo json_encode( $database->getPosterInformation( $request['params']['round_id'] ) );

?>