<?php

namespace App\Controllers;
use \PDO;
use App\Models\Comment;

class CommentController extends BaseController {

	protected $Comment;

	public function __construct(\PDO $conn){
		parent::__construct($conn);
		$this->Comment = new Comment($conn);
	}

	public function save($postid)
	{
		$data = $_POST;
		$this->Comment->saveComment($postid,$data);
		redirect("/post/$postid");
	}

	public function deleteComment($postid)
	{
		$this->Comment->delete($postid);
		redirect("/");
	}
}