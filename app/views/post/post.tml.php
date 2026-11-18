<?php
$title = htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($post->message, ENT_QUOTES, 'UTF-8');
$author = htmlspecialchars($post->author ?? 'Mioblog contributor', ENT_QUOTES, 'UTF-8');
$date = !empty($post->datecreated) ? date('F j, Y', strtotime($post->datecreated)) : '';
$excerpt = htmlspecialchars(substr(strip_tags($post->message), 0, 190), ENT_QUOTES, 'UTF-8');
$artStyle = (((int)$post->id - 1) % 4) + 1;
$canManage = loggedIn() && ((int)$post->user_id === (int)getUserId() || getUserRole() === 'admin');
?>
<article class="article-page">
	<a class="article-back" href="/"><span aria-hidden="true">←</span> Back to the journal</a>
	<header class="article-header">
		<span class="eyebrow">A story from the journal</span>
		<h1><?=$title?></h1>
		<p class="article-header__excerpt"><?=$excerpt?><?=strlen(strip_tags($post->message)) > 190 ? '...' : ''?></p>
		<div class="article-byline">
			<span>By <?=$author?></span>
			<span class="byline-dot" aria-hidden="true"></span>
			<time datetime="<?=htmlspecialchars($post->datecreated ?? '', ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($date, ENT_QUOTES, 'UTF-8')?></time>
			<span class="byline-dot" aria-hidden="true"></span>
			<span><?=max(1, (int)ceil(str_word_count(strip_tags($post->message)) / 200))?> min read</span>
		</div>
	</header>

	<div class="story-art story-art--<?=$artStyle?> article-cover" aria-hidden="true"></div>
	<div class="article-body"><?=$message?></div>

	<div class="article-actions">
		<button class="button button--outline button--small" type="button" data-share>Share this story <span aria-hidden="true">↗</span></button>
		<span class="share-status" aria-live="polite" data-share-status></span>
		<?php if ($canManage): ?>
			<div class="article-admin">
				<a class="button button--outline button--small" href="/post/<?=urlencode((string)$post->id)?>/edit">Edit story</a>
				<form action="/post/<?=urlencode((string)$post->id)?>/delete" method="post" data-confirm="Delete this story? This cannot be undone.">
					<button class="button button--danger button--small" type="submit">Delete</button>
				</form>
			</div>
		<?php endif ?>
	</div>

	<section class="comments" aria-labelledby="comments-title">
		<h2 class="comments__heading" id="comments-title">The conversation <span class="comments__count"><?=count($comments)?></span></h2>
		<?php if (!empty($_SESSION['message'])): ?>
			<div class="flash-message <?=!empty($_SESSION['success']) ? 'flash-message--success' : 'flash-message--error'?>" role="status">
				<?=htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')?>
			</div>
			<?php unset($_SESSION['message'], $_SESSION['success']); ?>
		<?php endif ?>
		<form class="comment-form" action="/post/<?=urlencode((string)$post->id)?>/comment" method="post">
			<div class="field">
				<label for="comment-email">Email address</label>
				<input type="email" name="email" id="comment-email" value="<?=htmlspecialchars(loggedIn() ? getEmailUser() : '', ENT_QUOTES, 'UTF-8')?>" placeholder="you@example.com" required>
			</div>
			<div class="field">
				<label for="comment">Add to the conversation</label>
				<textarea name="comment" id="comment" minlength="2" maxlength="3000" placeholder="Share a thoughtful response..." required></textarea>
			</div>
			<button class="button button--dark" type="submit">Post comment <span aria-hidden="true">↗</span></button>
		</form>
		<?php if ($comments): ?>
			<div class="comment-list">
				<?php foreach ($comments as $comment): ?>
					<div class="comment-item">
						<div class="comment-item__meta">
							<strong><?=htmlspecialchars($comment->email ?: 'Mioblog reader', ENT_QUOTES, 'UTF-8')?></strong>
							<time datetime="<?=htmlspecialchars($comment->datecreated ?? '', ENT_QUOTES, 'UTF-8')?>"><?=!empty($comment->datecreated) ? date('M j, Y · g:i a', strtotime($comment->datecreated)) : ''?></time>
						</div>
						<p><?=htmlspecialchars($comment->comment, ENT_QUOTES, 'UTF-8')?></p>
						<?php if (loggedIn() && (getUserRole() === 'admin' || (int)$comment->user_id === (int)getUserId())): ?>
							<form action="/comment/<?=urlencode((string)$comment->id)?>/delete" method="post" data-confirm="Remove this comment?">
								<button class="button button--quiet button--small" type="submit">Remove comment</button>
							</form>
						<?php endif ?>
					</div>
				<?php endforeach ?>
			</div>
		<?php else: ?>
			<p class="comment-empty">No comments yet. Start the conversation.</p>
		<?php endif ?>
	</section>
</article>
