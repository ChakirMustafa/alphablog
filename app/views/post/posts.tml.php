<?php
$featured = $posts[0] ?? null;
$latestPosts = array_slice($posts, 1);
$totalStories = count($posts);
?>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="flash-message <?=!empty($_SESSION['success']) ? 'flash-message--success' : 'flash-message--error'?>" role="status">
		<?=htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')?>
	</div>
	<?php unset($_SESSION['message'], $_SESSION['success']); ?>
<?php endif ?>

<section class="home-hero" aria-labelledby="home-title">
	<div class="home-hero__copy">
		<span class="eyebrow">A journal for the curious</span>
		<h1 id="home-title">A little more curious. <em>A little more connected.</em></h1>
		<p>Small moments, fresh perspectives, and stories from people who notice the world around them.</p>
		<div class="hero-actions">
			<a class="button button--dark" href="#latest-stories">Explore the stories <span aria-hidden="true">↓</span></a>
			<?php if (loggedIn()): ?>
				<a class="button button--outline" href="/post/create">Write a story <span aria-hidden="true">↗</span></a>
			<?php else: ?>
				<a class="button button--outline" href="/auth/formsignup">Become a writer <span aria-hidden="true">↗</span></a>
			<?php endif ?>
		</div>
		<p class="hero-note"><strong><?=number_format($totalStories)?></strong> thoughtful <?= $totalStories === 1 ? 'story' : 'stories' ?> and counting</p>
	</div>

	<?php if ($featured): ?>
		<?php
		$featuredTitle = htmlspecialchars($featured->title, ENT_QUOTES, 'UTF-8');
		$featuredMessage = htmlspecialchars($featured->message, ENT_QUOTES, 'UTF-8');
		$featuredAuthor = htmlspecialchars($featured->author ?? 'Mioblog contributor', ENT_QUOTES, 'UTF-8');
		$featuredDate = !empty($featured->datecreated) ? date('M j, Y', strtotime($featured->datecreated)) : '';
		$featuredReadTime = max(1, (int)ceil(str_word_count(strip_tags($featured->message)) / 200));
		?>
		<a class="hero-feature" href="/post/<?=urlencode((string)$featured->id)?>" data-story-item data-story-text="<?=htmlspecialchars(strtolower($featured->title.' '.$featured->message.' '.$featuredAuthor), ENT_QUOTES, 'UTF-8')?>">
			<div class="hero-feature__content">
				<div class="hero-feature__meta">
					<span class="hero-feature__tag">Editor's pick</span>
					<span><?=htmlspecialchars($featuredDate, ENT_QUOTES, 'UTF-8')?></span>
				</div>
				<h2><?=$featuredTitle?></h2>
				<p><?=htmlspecialchars(substr(strip_tags($featured->message), 0, 155), ENT_QUOTES, 'UTF-8')?><?=strlen(strip_tags($featured->message)) > 155 ? '...' : ''?></p>
				<span class="hero-feature__link">Read the story <span aria-hidden="true">↗</span> <span><?=$featuredReadTime?> min read</span></span>
			</div>
		</a>
	<?php else: ?>
		<div class="empty-state">
			<span class="eyebrow">Your next good read starts here</span>
			<h2>The journal is ready for its first story.</h2>
			<p>Join the conversation, share something you have noticed, or publish the first story yourself.</p>
			<a class="button button--accent" href="<?=loggedIn() ? '/post/create' : '/auth/formsignup'?>"><?=loggedIn() ? 'Write the first story' : 'Join the journal'?></a>
		</div>
	<?php endif ?>
</section>

<?php if ($latestPosts): ?>
	<section id="latest-stories" aria-labelledby="latest-title">
		<div class="story-tools">
			<div>
				<p class="section-kicker">Fresh from the journal</p>
				<h2 class="section-title" id="latest-title">Latest stories</h2>
			</div>
			<label class="search-wrap">
				<span class="sr-only">Search stories</span>
				<input class="search-input" type="search" placeholder="Search stories..." autocomplete="off" data-story-search>
			</label>
		</div>
		<div class="post-grid" data-story-grid>
			<?php foreach ($latestPosts as $index => $post): ?>
				<?php
				$title = htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8');
				$message = strip_tags($post->message);
				$author = htmlspecialchars($post->author ?? 'Mioblog contributor', ENT_QUOTES, 'UTF-8');
				$date = !empty($post->datecreated) ? date('M j, Y', strtotime($post->datecreated)) : '';
				$readTime = max(1, (int)ceil(str_word_count($message) / 200));
				$artStyle = (($index % 4) + 1);
				?>
				<article class="story-card" data-story-item data-story-text="<?=htmlspecialchars(strtolower($post->title.' '.$message.' '.$author), ENT_QUOTES, 'UTF-8')?>">
					<a href="/post/<?=urlencode((string)$post->id)?>" aria-label="Read <?= $title ?>">
						<div class="story-art story-art--<?=$artStyle?>" aria-hidden="true"></div>
					</a>
					<div class="story-card__body">
						<div class="story-card__meta">
							<time datetime="<?=htmlspecialchars($post->datecreated ?? '', ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($date, ENT_QUOTES, 'UTF-8')?></time>
							<span><?=$readTime?> min read</span>
						</div>
						<h3><a href="/post/<?=urlencode((string)$post->id)?>"><?=$title?></a></h3>
						<p class="story-card__excerpt"><?=htmlspecialchars(substr($message, 0, 135), ENT_QUOTES, 'UTF-8')?><?=strlen($message) > 135 ? '...' : ''?></p>
						<div class="story-card__footer">
							<span class="story-author">By <?=$author?></span>
							<a class="read-link" href="/post/<?=urlencode((string)$post->id)?>">Read <span aria-hidden="true">↗</span></a>
						</div>
					</div>
				</article>
			<?php endforeach ?>
		</div>
		<p class="no-results" data-no-results>No stories match that search. Try another word.</p>
		<p class="story-count" aria-live="polite" data-search-count></p>
	</section>
<?php elseif ($featured): ?>
	<section class="story-tools" id="latest-stories">
		<div>
			<p class="section-kicker">More to come</p>
			<h2 class="section-title">One story, a thousand ways to begin.</h2>
		</div>
	</section>
<?php endif ?>
