<div class="row">
	<div class="col-sm-6 offset-3">
	
		<h3><?=htmlentities($post->title)?></h3>
		<p><?=htmlentities($post->message)?></p>
		<?php if (loggedIn()): ?>
		<div class="from-group">
			<form class="form-inline" action="/post/<?=$post->id?>/edit" method="GET">
				<button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> UPDATE</button>

			</form>
			<form class="form-inline" action="/post/<?=$post->id?>/delete" method="POST">
				<button onclick="return confirm('Are you sure you want to delete the post <?=$post->id?> ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> DELETE</button>
			</form>
		</div>
	<?php endif ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 offset-3">
		<hr>
		<form action="/post/<?=$post->id?>/comment" method="post">
			<input type="hidden" name="postid" value="<?=$post->id?>">
			<label for="email">Email</label>
			<input required="" type="Email" name="email" class="form-control" placeholder="Your email!">
			<label for="comment">Comment</label>
			<textarea required="" name="comment" class="form-control" placeholder="Add a public comment..."></textarea>
			<button class="btn btn-info btn-width mt-3">Save comment</button>
		</form>
		<?php 
		if ($comments): 
			foreach($comments as $comment): ?>
				<div class="card-body">
					<?=$comment['message']?><br>
				 	Created by: <?=$comment['email']?>
				 	<form class="form" action="/post/<?=$comment['id']?>/deleteCom" method="post">
				 		<input type="submit" class="btn btn-danger btn-sm deleteCommet" value="Delete" >	
				 	</form>
				</div>
			<?php endforeach ?>
		 <?php endif ?>
	</div>
</div>
