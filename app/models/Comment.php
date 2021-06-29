<?php

namespace App\Models;
use \PDO;
class Comment {

	protected $conn;

	public function __construct(\PDO $conn)
	{
		$this->conn = $conn;
	}

	public function allComments($id)
	{
		$result = [];
		$sql = "SELECT * FROM comments WHERE postid = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			':id' => $id
		]);

		return $stm->fetchAll();
		
	}

	public function saveComment($postid, $data)
	{
		$postid = intval($postid);
		$sql = "INSERT INTO comments (postid, message, created_at, email) VALUES(:postid, :message, :created_at, :email)";

		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'postid' 	=> $postid,
			'message' 	=> $data['comment'],
			'created_at'=> date('Y-m-d H-i-s'),
			'email' 	=> $data['email'],
		]);

		return $stm->rowCount();
	}

	public function delete($id)
	{
		$id = intval($id);
		$sql = "DELETE FROM comments WHERE id =:id";
		$stm = $this->conn->prepare($sql);

		$stm->execute(['id' => $id]);

		return $stm->rowCount();
	}

}