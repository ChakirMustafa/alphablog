<?php 
namespace App\Controllers;

/**
 * @author mustafa chakir
*/
use App\Models\Post;
use App\Models\Comments;
use \PDO;


class PostController extends BaseController {

	protected $Post;
	protected $Comment;
	
	
	public function __construct(PDO $conn)
	{
		parent::__construct($conn);
		$this->Post = new Post($conn);
	}



	public function edit($postId)
	{
		$post = $this->Post->find($postId);
		$this->content = view('post/editPost', compact('post'));
	}


	public function show($postId)
	{
		$post = $this->Post->find($postId);
		$comment = new Comments($this->conn);
		$comments = $comment->allComments($postId);
		#var_dump($comments);die();
		$this->content = view('post/post', compact('post', 'comments'));
	}

	public function getPosts()
	{
		$posts = $this->Post->all();
		$this->content = view('post/posts', compact('posts'));
	}

	public function create()
	{
		$this->content = view('post/newPost');
	}

	public function store()
	{
		$data = $_POST;

		$result = $this->Post->store($data);
		redirect('/');	
	}

	public function save()
	{
		$data = $_POST;
		$this->Post->save($data);
		redirect('/');
	}

	public function delete($postId)
	{
		$this->Post->delete($postId);
		redirect('/');
	}
}