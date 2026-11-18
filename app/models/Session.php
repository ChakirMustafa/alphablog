<?php 

namespace App\Models;
use \PDO;
class Session {

	protected $conn;

	public function __construct(\PDO $conn)
	{
		$this->conn= $conn;
	}
	public function save(array $data): int
	{	
		$password = password_hash($data['password'], PASSWORD_DEFAULT);
		$sql  = "INSERT INTO users (username, email, password, roletype) ";
		$sql .= "VALUES(:username, :email, :password, 'user')";

		$stm = $this->conn->prepare($sql);

		$stm->execute([
			'username' 	=> $data['username'],
			'email' 	=> $data['email'],
			'password' 	=> $password,
		]);

		return (int)$this->conn->lastInsertId();
	}

	public function userByEmail($email)
	{
		$result = [];
		$sql = "SELECT * FROM users WHERE email = :email";
		$stm = $this->conn->prepare($sql);
		$stm->execute(['email' => $email]);

		if ($stm) {
			$result = $stm->fetch(PDO::FETCH_OBJ);
		}
		return $result;	
	}

		public function userById($id)
	{
		$result = [];
		$sql = "SELECT * FROM users WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute(['id' => $id]);

		if ($stm) {
			$result = $stm->fetch(PDO::FETCH_OBJ);
		}
		return $result;	
	}
}
