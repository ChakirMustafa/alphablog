<?php

namespace App\Models;

use PDO;

class Post
{
	protected PDO $conn;

	public function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}

	public function all(): array
	{
		$sql = 'SELECT posts.*, users.username AS author,
				(SELECT COUNT(*) FROM postscomments WHERE postscomments.post_id = posts.id) AS comment_count
			FROM posts
			LEFT JOIN users ON users.id = posts.user_id
			ORDER BY posts.datecreated DESC, posts.id DESC';

		return $this->conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
	}

	public function find($id)
	{
		$sql = 'SELECT posts.*, users.username AS author,
				(SELECT COUNT(*) FROM postscomments WHERE postscomments.post_id = posts.id) AS comment_count
			FROM posts
			LEFT JOIN users ON users.id = posts.user_id
			WHERE posts.id = :id';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => (int)$id]);

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function create(array $data, int $userId): int
	{
		$sql = 'INSERT INTO posts (title, message, user_id, datecreated)
			VALUES (:title, :message, :user_id, :datecreated)';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([
			'title' => trim($data['title']),
			'message' => trim($data['text']),
			'user_id' => $userId,
			'datecreated' => date('Y-m-d H:i:s'),
		]);

		return (int)$this->conn->lastInsertId();
	}

	public function update(array $data, int $userId, bool $isAdmin = false): bool
	{
		$sql = 'UPDATE posts SET title = :title, message = :message WHERE id = :id';
		$params = [
			'id' => (int)$data['id'],
			'title' => trim($data['title']),
			'message' => trim($data['text']),
		];

		if (!$isAdmin) {
			$sql .= ' AND user_id = :user_id';
			$params['user_id'] = $userId;
		}

		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($params);
	}

	public function delete($id, int $userId, bool $isAdmin = false): bool
	{
		$sql = 'DELETE FROM posts WHERE id = :id';
		$params = ['id' => (int)$id];

		if (!$isAdmin) {
			$sql .= ' AND user_id = :user_id';
			$params['user_id'] = $userId;
		}

		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($params);
	}
}
