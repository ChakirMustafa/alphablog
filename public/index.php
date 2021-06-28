<?php
 
chdir(dirname(__DIR__));

require  __DIR__.'/../core/bootstrap.php';
$options = require  'database/config.php';
$ruotes  = require 	'database/routesConfig.php';
try {
	# CONNECTION DB
	$conn = App\DB\DbPdo::getInstance($options)->getConn();
	
	# CLASS ROUTE
	$router = new Route($conn);
	$router->loudRoutes($ruotes['routes']);
	
	$controller = $router->dispatch();  
	$controller->display();	
	
} catch (\PDOException $e) {
    echo $e->getMessage();
} catch (\Exception $e){
   echo $e->getMessage();
}



	



