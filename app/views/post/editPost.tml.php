<h3 align="center">UPDATE POST</h3>
<form action="/post/store" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?=$post->id?>">
	<div class="row">
		<div class="from-group">
			<div class="col-sm-8 offset-2">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" value="<?=$post->title?>" class="form-control" placeholder="Enter the title">
			</div>
		</div>
			<div class="from-group">
			<div class="col-sm-8 offset-2">
				<label for="text">Text</label>
				<textarea name="text" id="text"  rows="10" class="form-control" placeholder="Enter the text">
					<?=$post->message?></textarea>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-8 offset-2">
				<label for="avatar">Image</label>
				<input type="file" name="avatar" id="avatar" class="form-control" accept="image/jpeg">
			</div>
		</div>&nbsp;
		<div class="from-group">
			<div class="col-sm-8 offset-2">
				<input type="submit" value="Update" class="btn btn-info">
			</div>
		</div>
	</div>
</form>