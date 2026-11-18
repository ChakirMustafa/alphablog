<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Mioblog: thoughtful stories, field notes, and ideas worth sharing.">
  <meta name="theme-color" content="#f6f4ef">
  <title>Mioblog — Stories worth staying for</title>
  <link rel="stylesheet" href="/css/journal.css">
</head>
<body>
  <header class="site-header">
    <div class="site-header__inner container">
      <a class="brand" href="/" aria-label="Mioblog home">
        <span class="brand__mark">M</span>
        <span>mio<span class="brand__light">blog</span></span>
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-nav-toggle>
        <span class="nav-toggle__line"></span>
        <span class="nav-toggle__line"></span>
        <span class="sr-only">Toggle navigation</span>
      </button>
      <nav class="site-nav" id="site-navigation" data-site-nav aria-label="Main navigation">
        <a class="site-nav__link" href="/">Discover</a>
        <?php if (loggedIn()): ?>
          <a class="site-nav__link" href="/post/create">Write a story <span class="nav-plus">+</span></a>
          <span class="nav-user">Hi, <?=htmlspecialchars(getUserName(), ENT_QUOTES, 'UTF-8')?></span>
          <form class="nav-logout" action="/auth/logout" method="post">
            <button class="button button--quiet button--small" type="submit">Log out</button>
          </form>
        <?php else: ?>
          <a class="site-nav__link" href="/auth/showLogin">Log in</a>
          <a class="button button--dark button--small" href="/auth/formsignup">Join the journal <span aria-hidden="true">↗</span></a>
        <?php endif ?>
      </nav>
    </div>
  </header>

  <main class="site-main container">
    <?= $this->content ?>
  </main>

  <footer class="site-footer">
    <div class="site-footer__inner container">
      <a class="brand brand--footer" href="/">
        <span class="brand__mark">M</span>
        <span>mio<span class="brand__light">blog</span></span>
      </a>
      <p>Ideas, moments, and stories worth sharing.</p>
      <span class="site-footer__copyright">&copy; Mioblog <?=date('Y')?></span>
    </div>
  </footer>
  <script src="/js/app.js" defer></script>
</body>
</html>
