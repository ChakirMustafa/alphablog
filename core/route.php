<?php 

class Route {

	protected $routes = [
		'GET' => [],
		'POST' => [],
	];

	protected $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	public function loudRoutes(array $routes)
	{
		$this->routes = $routes;
	}

	public function getRoutes()
	{
		return $this->routes;
	}

	public function dispatch()
	{
		$url 	 = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$url 	 = trim($url, '/');
		$method  = $_SERVER['REQUEST_METHOD'];
		
		return $this->processqeue($url,$method);
		}

	protected function processqeue($uri, $method = 'GET')
	{
		$routes = $this->routes[$method];

		foreach ($routes as $route => $callback) {

			$regMatch = preg_quote($route);
			$subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)',  $regMatch);

			$pattern = "@^".$subPattern."$@D";

			$matches = [];

			if (preg_match($pattern,$uri, $matches)) {
				array_shift($matches);
				return $this->route($callback, $matches);
			}
		}
		echo('No matchin routes found for ' . $uri);die;
	}
	
	protected function route($callback, array $matches = [])
	{
		try{
			#var_dump(func_num_args());die();
			if (is_callable($callback)) {
				return call_user_func_array($callback, $matches);
			}
			$token 	 = explode('@', $callback);
			$controller  = $token[0];
			$method      = $token[1];
			#var_dump($controller); die();
			$class = new $controller($this->conn);
			if (method_exists($controller, $method)) {
				call_user_func_array([$class, $method], $matches);
				return $class;
			}else{
				echo('The method '.$method.' is not found in class '. $controller);die;
			}
		} catch (Exception $e){
            die($e->getMessage());
        }
	}	
}