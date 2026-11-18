<?php

namespace App\Controllers;
use \PDO;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends BaseController {

	protected $Comment;
	protected $Post;

	public function __construct(\PDO $conn){
		parent::__construct($conn);
		$this->Comment = new Comment($conn);
		$this->Post = new Post($conn);
	}

	public function save($postid)
	{
		$data = $_POST;
		$email = trim($data['email'] ?? '');
		$comment = trim($data['comment'] ?? '');

		if (!$this->Post->find($postid)) {
			$_SESSION['message'] = 'That story could not be found.';
			$_SESSION['success'] = false;
			redirect('/');
			return;
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($comment) < 2 || strlen($comment) > 3000) {
			$_SESSION['message'] = 'Enter a valid email and a comment between 2 and 3,000 characters.';
			$_SESSION['success'] = false;
			redirect('/post/'.(int)$postid);
			return;
		}

		$this->Comment->saveComment(
			(int)$postid,
			['email' => $email, 'comment' => $comment],
			loggedIn() ? (int)getUserId() : null
		);
		$_SESSION['message'] = 'Thanks for joining the conversation.';
		$_SESSION['success'] = true;
		redirect("/post/$postid");
	}

	public function delete($commentId)
	{
		if (!loggedIn()) {
			$_SESSION['message'] = 'Log in to manage comments.';
			$_SESSION['success'] = false;
			redirect('/auth/showLogin');
			return;
		}

		$comment = $this->Comment->find($commentId);
		$canDelete = $comment &&
			(getUserRole() === 'admin' || (int)$comment->user_id === (int)getUserId());

		if ($canDelete) {
			$this->Comment->delete((int)$commentId, (int)getUserId(), getUserRole() === 'admin');
			$_SESSION['message'] = 'Your comment has been removed.';
			$_SESSION['success'] = true;
			redirect('/post/'.(int)$comment->post_id);
			return;
		}

		$_SESSION['message'] = 'You cannot delete this comment.';
		$_SESSION['success'] = false;
		redirect('/');
	}
}
