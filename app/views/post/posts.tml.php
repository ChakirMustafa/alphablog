<div class="row">
	<div class="col-sm-10 offset-1">
		<?php 
			if (!empty($_SESSION['message'])) {
				$message = $_SESSION['message'];
				$alertType = $_SESSION['success'] ? 'success' : 'danger';
				require('app/views/notice.php');
				unset($_SESSION['message']);
			} 
		?>
	</div>
</div>
<?php if (empty($posts)): ?>
	<div class="row">
		<div class="col-sm-10 offset-1">
			<div class="card text-center my-5">
				<div class="card-body">
					<h2 class="card-title">No posts yet</h2>
					<p class="card-text">The database is connected, but there are no blog posts to display yet.</p>
					<?php if (loggedIn()): ?>
						<a class="btn btn-success" href="/post/create">Create the first post</a>
					<?php else: ?>
						<a class="btn btn-success" href="/auth/formsignup">Sign up to get started</a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
<?php

foreach ($posts as $post): 
	$avatarDir 		= getConfig('avatarDir');
	$avatarDirWeb 	= getConfig('avatarDirWeb');
	$thumbnailWidth = getConfig('thumbnailWidth');
	$avatar = isset($post->avatar) ? $post->avatar : '';
	$image = 	!empty($avatar) && file_exists($avatarDir.$avatar)?
				$avatarDirWeb.$avatar : $avatarDirWeb.'placeholder.jpg';

?>
	<div class="row">
		<div class="col-sm-4">
			<img src="<?=$image?>" width="<?=$thumbnailWidth?>">
		</div>
		<div class="col-sm-8 img-index">
			<h6><a href="post/<?=$post->id?>"><?=strtoupper($post->title)?></a></h6>
			<p><?= substr($post->message, 0,400)?><a href="post/<?=$post->id?>">  ...read more</a></p>
		</div>
	</div>
	<hr>
<?php endforeach ?>
