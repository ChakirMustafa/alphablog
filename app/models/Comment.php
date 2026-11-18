<?php

namespace App\Models;

use PDO;

class Comment
{
	protected PDO $conn;

	public function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}

	public function allComments($postId): array
	{
		$stmt = $this->conn->prepare(
			'SELECT id, post_id, comment, datecreated, email, user_id
			 FROM postscomments
			 WHERE post_id = :post_id
			 ORDER BY datecreated DESC, id DESC'
		);
		$stmt->execute(['post_id' => (int)$postId]);

		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function saveComment(int $postId, array $data, ?int $userId = null): bool
	{
		$stmt = $this->conn->prepare(
			'INSERT INTO postscomments (post_id, comment, datecreated, email, user_id)
			 VALUES (:post_id, :comment, :datecreated, :email, :user_id)'
		);

		return $stmt->execute([
			'post_id' => $postId,
			'comment' => trim($data['comment']),
			'datecreated' => date('Y-m-d H:i:s'),
			'email' => trim($data['email']),
			'user_id' => $userId,
		]);
	}

	public function find($commentId)
	{
		$stmt = $this->conn->prepare('SELECT * FROM postscomments WHERE id = :id');
		$stmt->execute(['id' => (int)$commentId]);

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function delete($commentId, int $userId, bool $isAdmin = false): bool
	{
		$sql = 'DELETE FROM postscomments WHERE id = :id';
		$params = ['id' => (int)$commentId];
		if (!$isAdmin) {
			$sql .= ' AND user_id = :user_id';
			$params['user_id'] = $userId;
		}

		return $this->conn->prepare($sql)->execute($params);
	}
}
