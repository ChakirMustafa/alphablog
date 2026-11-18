<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use PDO;

class PostController extends BaseController
{
	protected Post $Post;
	protected Comment $Comment;

	public function __construct(PDO $conn)
	{
		parent::__construct($conn);
		$this->Post = new Post($conn);
		$this->Comment = new Comment($conn);
	}

	public function edit($postId)
	{
		if (!$this->requireLogin()) {
			return;
		}

		$post = $this->Post->find($postId);
		if (!$post || !$this->canManage($post)) {
			$_SESSION['message'] = 'You cannot edit this story.';
			$_SESSION['success'] = false;
			redirect('/');
			return;
		}

		$this->content = view('post/editPost', compact('post'));
	}

	public function show($postId)
	{
		$post = $this->Post->find($postId);
		if (!$post) {
			$_SESSION['message'] = 'That story could not be found.';
			$_SESSION['success'] = false;
			redirect('/');
			return;
		}

		$comments = $this->Comment->allComments($postId);
		$this->content = view('post/post', compact('post', 'comments'));
	}

	public function getPosts()
	{
		$posts = $this->Post->all();
		$this->content = view('post/posts', compact('posts'));
	}

	public function create()
	{
		if (!$this->requireLogin()) {
			return;
		}

		$this->content = view('post/newPost');
	}

	public function store()
	{
		if (!$this->requireLogin()) {
			return;
		}

		$data = $_POST;
		if (!$this->validStory($data)) {
			$_SESSION['message'] = 'Add a title and a story between 20 and 20,000 characters.';
			$_SESSION['success'] = false;
			redirect('/post/create');
			return;
		}

		$post = $this->Post->find($data['id'] ?? 0);
		if (!$post || !$this->canManage($post)) {
			$_SESSION['message'] = 'You cannot edit this story.';
			$_SESSION['success'] = false;
			redirect('/');
			return;
		}

		$updated = $this->Post->update($data, (int)getUserId(), getUserRole() === 'admin');
		if (!$updated) {
			$_SESSION['message'] = 'The story could not be updated.';
			$_SESSION['success'] = false;
			redirect('/');
			return;
		}

		$_SESSION['message'] = 'Your story has been updated.';
		$_SESSION['success'] = true;
		redirect('/post/'.(int)$data['id']);
	}

	public function save()
	{
		if (!$this->requireLogin()) {
			return;
		}

		$data = $_POST;
		if (!$this->validStory($data)) {
			$_SESSION['message'] = 'Add a title and a story between 20 and 20,000 characters.';
			$_SESSION['success'] = false;
			redirect('/post/create');
			return;
		}

		$postId = $this->Post->create($data, (int)getUserId());
		$_SESSION['message'] = 'Your story is now live.';
		$_SESSION['success'] = true;
		redirect('/post/'.$postId);
	}

	public function delete($postId)
	{
		if (!$this->requireLogin()) {
			return;
		}

		$post = $this->Post->find($postId);
		if ($post && $this->canManage($post)) {
			$this->Post->delete($postId, (int)getUserId(), getUserRole() === 'admin');
			$_SESSION['message'] = 'The story has been deleted.';
			$_SESSION['success'] = true;
		} else {
			$_SESSION['message'] = 'You cannot delete this story.';
			$_SESSION['success'] = false;
		}

		redirect('/');
	}

	private function requireLogin(): bool
	{
		if (loggedIn()) {
			return true;
		}

		$_SESSION['message'] = 'Log in to continue.';
		$_SESSION['success'] = false;
		redirect('/auth/showLogin');
		return false;
	}

	private function canManage($post): bool
	{
		return loggedIn() && ((int)$post->user_id === (int)getUserId() || getUserRole() === 'admin');
	}

	private function validStory(array $data): bool
	{
		$title = trim($data['title'] ?? '');
		$text = trim($data['text'] ?? '');

		return $title !== '' && strlen($title) <= 255 && strlen($text) >= 20 && strlen($text) <= 20000;
	}
}
