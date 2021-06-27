<?php
if (empty($user)) {
	$user = [
		'id' => '',
		'username' => '',
		'email' => '',
		'roletype' => '',

	];
}
?>
<h2 align="center"><?= $_SESSION['logged']? 'EDIT ACCOUNT' : 'SIGNUP'?></h2>
<form action="/auth/signup" method="post">
	<div class="row">
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="username">Username</label>
				<input type="text" value="<?=$user['username']?>" name="username" id="username" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="email">Email</label>
				<input type="email" value="<?=$user['email']?>" name="email" id="email" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="password">password</label>
				<input type="password"  name="password" id="password" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="roletype">Role</label>
				<input type="text" value="<?=$user['roletype']?>" name="roletype" id="roletype" class="form-control" required>
			</div>
		</div>&nbsp;
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<input type="submit" class="btn btn-success btn-width2" value="<?= $user['id']? 'Edit account' : 'Signup'?>">
				<p><small>Are you already registered?<a href="/auth/showLogin">Login</a></small></p>
			</div>
		</div>
	</div>
</form>