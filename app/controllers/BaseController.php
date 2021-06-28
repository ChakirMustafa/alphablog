<?php 

namespace App\Controllers;
use \PDO;
/**
 * 
 */
class BaseController
{
	protected $content = 'Chakir Mustapha';
	protected $conn;
	protected $template = 'resources/template.php';


	public function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}



	public function display()
	{
		require $this->template;
	}
}