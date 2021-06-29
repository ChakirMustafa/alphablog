<?php
 
chdir(dirname(__DIR__));

require  __DIR__.'/../core/bootstrap.php';
$options = require  'database/config.php';
$ruotes  = require 	'database/routesConfig.php';
try {
	# CONNECTION DB
	$dbPdo = App\DB\DbPdo::getInstance($options);
	$conn = $dbPdo->getConn();
	
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



	



