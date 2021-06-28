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
<?php

foreach ($posts as $post): 
	$avatarDir 		= getConfig('avatarDir');
	$avatarDirWeb 	= getConfig('avatarDirWeb');
	$thumbnailWidth = getConfig('thumbnailWidth');
	$image = 	file_exists($avatarDir.$post->avatar)?
				$avatarDirWeb.$post->avatar : $avatarDirWeb.'placeholder.jpg';

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