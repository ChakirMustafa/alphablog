<div class="form-page">
	<header class="form-page__header">
		<span class="eyebrow">Keep the good ideas growing</span>
		<h1>Edit your story</h1>
		<p>Make your changes and publish the updated version.</p>
	</header>
	<form class="editor-card" action="/post/store" method="post">
		<input type="hidden" name="id" value="<?=(int)$post->id?>">
		<div class="field">
			<label for="title">Story title</label>
			<input type="text" name="title" id="title" value="<?=htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8')?>" maxlength="255" required>
		</div>
		<div class="field">
			<label for="text">Your story</label>
			<textarea name="text" id="text" minlength="20" maxlength="20000" required data-character-input><?=htmlspecialchars($post->message, ENT_QUOTES, 'UTF-8')?></textarea>
			<span class="field-help"><span data-character-count><?=strlen($post->message)?></span> / 20,000 characters · at least 20 characters</span>
		</div>
		<div class="form-actions">
			<button class="button button--accent" type="submit">Save changes <span aria-hidden="true">↗</span></button>
			<a class="button button--outline" href="/post/<?=urlencode((string)$post->id)?>">Cancel</a>
		</div>
	</form>
</div>
