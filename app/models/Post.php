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
		$result = [
        'id' => 0,
        'success' => false,
        'message' => 'PROBLEM SAVING USER',
    	];
		#var_dump((int)$_SESSION['user']['id']);die();
		$sql  = "INSERT INTO posts (title, message, user_id, created_at) VALUES(:title, :message, :user_id, :created_at)";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'title' 	=> $data['title'],
			'message' 	=> $data['text'],
			'user_id' 	=> $data['user_id'],
			'created_at' => date('Y-m-d H-i-s'),
		]);

	    if($stm) {
        $result['id'] = $this->conn->lastInsertId();
       	$result['message'] = 'POST WAS SUCCESSFULLY SAVED';
        $result['success'] = 1;
	    } else {
	        $result['message'] = $this->conn->error;
	    }
	    return  $result;
	}

	public function addAvatar($id, $resAvatar)
	{
		$sql  = "UPDATE posts SET avatar=:avatar WHERE id =:id";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'id' 	 => $id,
			'avatar' => $resAvatar,
		]);

		return $stm->rowCount();
	}

	public function store(array $data)
	{ 
		$sql = "UPDATE posts SET title =:title, message =:message, updated_at =:updated_at, ";
		
		$sql .=" user_id=:user_id WHERE id =:id";
		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'id' 		=> $data['id'],
			'title' 	=> $data['title'],
			'message' 	=> $data['text'],
			'updated_at'=> date('Y-m-d H-i-s'),
			'user_id' 	=> $data['user_id'],
		]);
	
		return $stm->rowCount();
		
		
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