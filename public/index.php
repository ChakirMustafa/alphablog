<?php
 
	chdir(__DIR__);
	require_once('../database/bootstrap.php');
	try {
		# CONNECTION DB
		$conn = App\DB\DbPdo::getInstance($options)->getConn();
		
		# CLASS ROUTE
		$router = new App\Core\Route($conn);
		$router->loudRoutes($ruotes['routes']);
		
		$controller = $router->dispatch();  # MI RITORNA IL CONTROLLER
		$controller->display();				# USO IL CONTROLLER RITORNATO PER CHIAMARE I METHODI DEL CONTROLLER STESSO
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	} catch (\Exception $e){
	   echo $e->getMessage();
	}



	



