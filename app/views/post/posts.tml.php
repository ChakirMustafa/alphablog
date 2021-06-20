
<div class="row">
	<div class="col-sm-10 offset-1">
		<?php 
		if (!empty($_SESSION['message'])) {
			$message = $_SESSION['message'];
			$alertType = $_SESSION['success'] ? 'success' : 'danger';
			require('../app/views/notice.php');
			unset($_SESSION['message']);
		} ?>
	</div>
</div>
<?php
foreach ($posts as $post): ?>
	<div class="row">
		<div class="col-sm-10 offset-1">
			<h6 align="center"><a href="post/<?=$post->id?>"><?=strtoupper($post->title)?></a></h6>
			<p><?= substr($post->message, 0,230)  ?> <a href="post/<?=$post->id?>">Continue >>></a></p>
			<hr>
		</div>
	</div>
<?php endforeach ?>