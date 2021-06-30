<?php
 
chdir(dirname(__DIR__));

require  __DIR__.'/../core/bootstrap.php';
$options = require  'database/config.php';
$ruotes  = require 	'database/routesConfig.php';

try {

	$conn = App\db\DbPdo::getInstance($options)->getConn();
	
	$router = new Route($conn);
	$router->loudRoutes($ruotes['routes']);
	
	$controller = $router->dispatch();  
	$controller->display();	
	
} catch (\PDOException $e) {
    echo $e->getMessage();
}