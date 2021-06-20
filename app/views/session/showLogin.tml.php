<h2 align="center">LOGIN</h2>
<div class="from-group">
	<div class="col-sm-6 offset-3">
		<?php
		if (!empty($_SESSION['message'])) {
			$message = $_SESSION['message'];
			$alertType = $_SESSION['success']? 'success' : 'danger';
			require('../app/views/notice.php');
			unset($_SESSION['message']);
		} ?>
	</div>
</div>
<form action="/auth/login" method="post">
	<input type="hidden" name="csrf" value="<?=$token?>">
	<div class="row">
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control" required>
			</div>
		</div>
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" required>
			</div>
		</div>
		</div>&nbsp;
		<div class="from-group">
			<div class="col-sm-6 offset-3">
				<input type="submit" class="btn btn-success btn-width2" value="Login">
			</div>
		</div>
	</div>