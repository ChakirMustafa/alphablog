<?php 
namespace App\Controllers;

/**
 * @author mustafa chakir
*/
use App\Models\Post;
use App\Models\Comment;
use \PDO;


class PostController extends BaseController {

	protected $Post;
	protected $Comment;
	
	
	public function __construct(PDO $conn)
	{
		parent::__construct($conn);
		$this->Post = new Post($conn);
		$this->Comment = new Comment($this->conn);
	}



	public function edit($postId)
	{
		$post = $this->Post->find($postId);
		$this->content = view('post/editPost', compact('post'));
	}


	public function show($postId)
	{
		$post = $this->Post->find($postId);
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
		$this->content = view('post/newPost');
	}

	public function store()
	{
		$data = $_POST;
		$data['user_id'] = getUserId();
		$res = $this->Post->store($data);

		if ($res) {
			$resCopy = $this->saveAvatar($data['id']);
	
		
			if ($resCopy['success']) {
				$resAvatar = $resCopy['filename'];
				#var_dump($data['id'],$resAvatar);die();
				$this->Post->addAvatar($data['id'],$resAvatar);
			}
		}
		
		redirect('/');	
	}

	public function save()
	{
		$data = $_POST;
		$data['user_id'] = getUserId();
		$res = $this->Post->save($data);
		if ($res['success']) {
			$resAvatar = $this->saveAvatar($res['id']);
			$resAvatarName = $resAvatar['filename'];
			$this->Post->addAvatar($res['id'],$resAvatarName);
		}
		redirect('/');
	}

	public function delete($postId)
	{
		$this->Post->delete($postId);
		redirect('/');
	}

	private function saveAvatar($id)
	{
		$result = [
			'message'  => 'THE IMAGE IS SUCCESSFULLY SAVED',
			'success' => true,
			'filename' => ''
		];

		if (empty($_FILES)) {
			$result = [
			'message'  => 'NO FILE UPLOADED',
			'success' => false
			];
			return $result;
		}

		$FILE = $_FILES['avatar'];

		if (!is_uploaded_file($FILE['tmp_name'])) {
			$result = [
			'message'  => 'THE FILE IS NOT UPLOADED VIA HTTP',
			'success' => false
			];
			return $result;
		}

		
	    $finfo = finfo_open(FILEINFO_MIME);
	    $info =  finfo_file($finfo , $FILE['tmp_name']);

	    if(stristr($info ,'image/jpeg') === false){
	        $result['message'] = 'THE UPLOADED FILE IS NOT JPEG';
	        return $result;
	    }
		
		$fileSize = getConfig('fileSize');
		if ($FILE['size'] > $fileSize) {
			$result = [
			'message'  => 'THE FILE IS UPLOADED TOO BIG',
			'success' => false
			];
			return $result;
		}
		$avatarDir = getConfig('avatarDir');
		$filename = $id.'.'. str_replace('.', '', microtime(true)).'.jpg';
		if (!move_uploaded_file($FILE['tmp_name'], $avatarDir.$filename)) {
			$result = [
				'result'   => 'THE FILE WAS NOT SAVED',
				'success' => false
			];
		}
		$result['filename'] = $filename;
		return $result;
	}
}