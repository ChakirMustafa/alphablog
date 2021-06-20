<h2 align="center">NEW POST</h2>
<form action="/post/save" method="post">
	<div class="row">
		<div class="from-group">
			<div class="col-sm-8 offset-2">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="Enter the title">
			</div>
		</div>
			<div class="from-group">
			<div class="col-sm-8 offset-2">
				<label for="text">Text</label>
				<textarea name="text" id="text" rows="10" class="form-control" placeholder="Enter the text"></textarea>
			</div>
		</div>&nbsp;
		<div class="from-group">
			<div class="col-sm-8 offset-2">
				<input type="submit" class="btn btn-info" value="New post">
			</div>
		</div>
	</div>
</form>