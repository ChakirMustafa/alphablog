<?php

namespace App\Controllers;

use App\Models\Session;
use PDO;

class AuthController extends BaseController
{
	protected Session $Log;

	public function __construct(PDO $conn)
	{
		parent::__construct($conn);
		$this->Log = new Session($conn);
	}

	public function login()
	{
		$email = trim($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		$token = $_POST['csrf'] ?? '';

		$user = $this->verifyLogin($password, $email, $token);
		if (!$user) {
			$_SESSION['success'] = false;
			$_SESSION['message'] = 'Email or password not recognized. Please try again.';
			redirect('/auth/showLogin');
			return;
		}

		session_regenerate_id(true);
		$_SESSION['user'] = (array)$user;
		$_SESSION['logged'] = true;
		$_SESSION['success'] = true;
		$_SESSION['message'] = 'Welcome back, '.($user->username ?: 'writer').'!';
		redirect('/');
	}

	public function showLogin()
	{
		$this->content = view('session/showLogin', ['token' => $this->issueToken()]);
	}

	public function formsignup()
	{
		$this->content = view('session/formsignup', ['token' => $this->issueToken()]);
	}

	public function signup()
	{
		$username = trim($_POST['username'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		$token = $_POST['csrf'] ?? '';

		if (!$this->validToken($token)) {
			$_SESSION['success'] = false;
			$_SESSION['message'] = 'Your form expired. Please try again.';
			redirect('/auth/formsignup');
			return;
		}

		if (strlen($username) < 2 || strlen($username) > 64 ||
			!filter_var($email, FILTER_VALIDATE_EMAIL) ||
			strlen($password) < 8 || strlen($password) > 72) {
			$_SESSION['success'] = false;
			$_SESSION['message'] = 'Use a name, a valid email, and a password between 8 and 72 characters.';
			redirect('/auth/formsignup');
			return;
		}

		if ($this->Log->userByEmail($email)) {
			$_SESSION['success'] = false;
			$_SESSION['message'] = 'An account with that email already exists.';
			redirect('/auth/formsignup');
			return;
		}

		$userId = $this->Log->save([
			'username' => $username,
			'email' => $email,
			'password' => $password,
		]);
		$user = $this->Log->userById($userId);

		session_regenerate_id(true);
		$_SESSION['user'] = (array)$user;
		$_SESSION['logged'] = true;
		$_SESSION['success'] = true;
		$_SESSION['message'] = 'Welcome to Mioblog, '.$username.'!';
		redirect('/');
	}

	public function logout()
	{
		$_SESSION = [];
		session_regenerate_id(true);
		redirect('/');
	}

	private function verifyLogin(string $password, string $email, string $token)
	{
		if (!$this->validToken($token) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
			return false;
		}

		$user = $this->Log->userByEmail($email);
		if (!$user || !password_verify($password, $user->password)) {
			return false;
		}

		return $user;
	}

	private function issueToken(): string
	{
		if (empty($_SESSION['csrf'])) {
			$_SESSION['csrf'] = bin2hex(random_bytes(32));
		}

		return $_SESSION['csrf'];
	}

	private function validToken(string $token): bool
	{
		return isset($_SESSION['csrf']) && $token !== '' && hash_equals($_SESSION['csrf'], $token);
	}
}
