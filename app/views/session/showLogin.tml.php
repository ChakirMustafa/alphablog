<div class="auth-layout">
	<section class="auth-aside">
		<span class="eyebrow">Welcome back</span>
		<h1>Your next good read is waiting.</h1>
		<p>Pick up where you left off, share a thought, or add a fresh story to the journal.</p>
		<blockquote class="auth-aside__quote">A thoughtful corner of the internet, made better by you.</blockquote>
	</section>
	<section class="auth-card">
		<h2>Log in to Mioblog</h2>
		<?php if (!empty($_SESSION['message'])): ?>
			<div class="flash-message <?=!empty($_SESSION['success']) ? 'flash-message--success' : 'flash-message--error'?>" role="alert">
				<?=htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')?>
			</div>
			<?php unset($_SESSION['message'], $_SESSION['success']); ?>
		<?php endif ?>
		<form action="/auth/login" method="post">
			<input type="hidden" name="csrf" value="<?=htmlspecialchars($token, ENT_QUOTES, 'UTF-8')?>">
			<div class="field">
				<label for="email">Email address</label>
				<input type="email" name="email" id="email" autocomplete="email" required>
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" autocomplete="current-password" required>
			</div>
			<div class="form-actions">
				<button class="button button--dark" type="submit">Log in <span aria-hidden="true">↗</span></button>
			</div>
			<p class="form-footnote">New around here? <a href="/auth/formsignup">Create your account</a></p>
		</form>
	</section>
</div>
