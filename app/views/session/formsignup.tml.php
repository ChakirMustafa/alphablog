<div class="auth-layout">
	<section class="auth-aside">
		<span class="eyebrow">Make room for a new point of view</span>
		<h1>Good stories bring us a little closer.</h1>
		<p>Create an account to publish your own notes, join conversations, and keep the journal growing.</p>
		<blockquote class="auth-aside__quote">“The world is full of small wonders, if only we take the time to look.”</blockquote>
	</section>
	<section class="auth-card">
		<h2>Create your account</h2>
		<?php if (!empty($_SESSION['message'])): ?>
			<div class="flash-message <?=!empty($_SESSION['success']) ? 'flash-message--success' : 'flash-message--error'?>" role="alert">
				<?=htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')?>
			</div>
			<?php unset($_SESSION['message'], $_SESSION['success']); ?>
		<?php endif ?>
		<form action="/auth/signup" method="post">
			<input type="hidden" name="csrf" value="<?=htmlspecialchars($token, ENT_QUOTES, 'UTF-8')?>">
			<div class="field">
				<label for="username">Your name</label>
				<input type="text" name="username" id="username" autocomplete="name" minlength="2" maxlength="64" required>
			</div>
			<div class="field">
				<label for="email">Email address</label>
				<input type="email" name="email" id="email" autocomplete="email" required>
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" autocomplete="new-password" minlength="8" maxlength="72" required>
				<span class="field-help">Use at least 8 characters.</span>
			</div>
			<div class="form-actions">
				<button class="button button--accent" type="submit">Create account <span aria-hidden="true">↗</span></button>
			</div>
			<p class="form-footnote">Already part of the journal? <a href="/auth/showLogin">Log in</a></p>
		</form>
	</section>
</div>
