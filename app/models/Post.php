<?php 

namespace App\Models;
use \PDO;
/**
 * @Author Mustafa chakir
 */
class Post {

	protected $conn;
	
	function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}

	public function all()
	{
		$result = [];
		$sql = "SELECT * FROM posts";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		if ($stm) {
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
		}
		return $result;
	}

	public function find($id)
	{
		$result = [];

		$sql  = "SELECT * FROM posts WHERE id = :id";
		$stmt = $this->conn->prepare($sql);

		$stmt->execute(['id' => $id]);

		if ($stmt) {
			$result = $stmt->fetch(PDO::FETCH_OBJ);
		}
		return $result;
	}

	public function save(array $data =[])
	{
		#var_dump($data);die();
		$sql  = "INSERT INTO posts (title, message, created_at) VALUES(:title, :message, :created_at)";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'title' 	=> $data['title'],
			'message' 	=> $data['text'],
			#'user_id' 	=> 1,
			'created_at' => date('Y-m-d H-i-s'),
		]);
		$res = $stm->rowCount();
		#var_dump($res);die();
		return $res;
	}

	public function store($data)
	{
		$sql = "UPDATE posts SET title =:title, message =:message, updated_at =:updated_at WHERE id =:id";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'id' => $data['id'],
			'title' => $data['title'],
			'message' => $data['text'],
			'updated_at' => date('Y-m-d H-i-s')
		
		]);
		if ($stm->errorCode()) {
			return $stm->errorCode();
		}else{
			return $stm->rowCount();
		}
		
	}

	public function delete($id)
	{
		$sql = "DELETE FROM posts WHERE id =:id";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'id' => $id,
		]);

		return $stm->rowCount();
	}
}