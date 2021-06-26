<?php 

namespace App\Controllers;
use App\Models\Session;
use \PDO;
class AuthController extends BaseController {

	protected $Log;
	protected $userByEmail;
	public function __construct(PDO $conn)
	{
		parent::__construct($conn);
		$this->Log = new Session($conn);
	}

	protected function verifyLogin($password, $email, $token)
	{

	$result = [
		'message'  	=> 'YOU ARE LOGGED!',
		'success' 	=> true,
		'user' 		=> ''
	];


	if ($_SESSION['csrf'] != $token) {

		$result = [
		'message'  => 'THE TOKEN ARE MISMATCHED',
		'success' => false
		];

		return $result;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = [
		'message'  => 'THE EMAIL IS NOT CORRECT',
		'success' => false
		];

		return $result;
	}

	if (strlen($password) < 4) {
		$result = [
		'message'  => 'THE PASSWORD IS TOO SHORT',
		'success' => false
		];
		return $result;
	}

	$userByEmail = $this->Log->userByEmail($email);
	#var_dump($this->userByEmail);die();
	if (!$userByEmail) {
		$result = [
		'message'  => 'THE USER IS NOT FOUND',
		'success' => false
		];
		return $result;
	}
		
	if (!password_verify($password, $userByEmail->password)) {
		$result = [
		'message'  => 'THE ENTERE PASSWORD IS NOT CORRECT',
		'success' => false
		];

	return $result;
	}


	$result['user'] = (array)$userByEmail;
	$result['success'] = true;

	return $result;
	}
	
	public function login()
	{
		$data = $_POST;
		if (!empty($_POST)) {
			$password = $_POST['password'];
			$email    = $_POST['email'];
			$token    = $_POST['csrf'];

			$result   = $this->verifyLogin($password, $email, $token);
			if ($result['success']) {
				session_regenerate_id();
				$_SESSION['success'] = $result['success'];
				$_SESSION['message'] = $result['message'];
				$_SESSION['user'] = (array)$result['user'];
				$_SESSION['logged'] = true;
				redirect('/');
			}else{
				$_SESSION['success'] = $result['success'];
	 			$_SESSION['message'] = $result['message'];
	 			redirect('/auth/showLogin');
			}
		}
	}

	private function token()
	{
		$bytes =random_bytes(32);
	  	$token = bin2hex($bytes);
		$_SESSION['csrf'] = $token;
		return $token;
	}


	public function showLogin()
	{
		$this->content = view('session/showlogin', ['token' => $this->token()]);
	}

	public function formsignup()
	{
		$this->content = view('session/formsignup');
	}

	public function edit($id)
	{
		$user = $this->Log->userById($id);
		$user = (array)$user;
		$this->content = view('session/formsignup', [
			'user' => $user
		]);
	}

	public function signup()
	{
		$data = $_POST;
		$this->Log->save($data);
		redirect('/');
	}

	public function logout()
	{
		$_SESSION = [];
		redirect('/');
	}



}