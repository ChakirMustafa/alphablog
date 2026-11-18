<div class="form-page">
	<header class="form-page__header">
		<span class="eyebrow">Your voice belongs here</span>
		<h1>Write a story</h1>
		<p>Start with a moment, an idea, or something you have been meaning to share.</p>
	</header>
	<form class="editor-card" action="/post/save" method="post">
		<div class="field">
			<label for="title">Story title</label>
			<input type="text" name="title" id="title" maxlength="255" placeholder="Give your story a thoughtful title" required>
		</div>
		<div class="field">
			<label for="text">Your story</label>
			<textarea name="text" id="text" minlength="20" maxlength="20000" placeholder="What would you like people to take away?" required data-character-input></textarea>
			<span class="field-help"><span data-character-count>0</span> / 20,000 characters · at least 20 characters</span>
		</div>
		<div class="form-actions">
			<button class="button button--accent" type="submit">Publish story <span aria-hidden="true">↗</span></button>
			<a class="button button--outline" href="/">Cancel</a>
		</div>
	</form>
</div>
