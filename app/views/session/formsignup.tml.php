<h2 align="center">SIGNUP</h2>
<form action="/auth/signup" method="post">
	<div class="row">
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="password">password</label>
				<input type="password" name="password" id="password" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="roletype">Role</label>
				<input type="text" name="roletype" id="roletype" class="form-control" required>
			</div>
		</div>&nbsp;
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<input type="submit" class="btn btn-success" value="Signup">
			</div>
		</div>
	</div>
</form>