<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title >Welcome to blog of Chakir</title>   
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/fontawesome/all.css">


    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
  
  <nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" title="Go to Homepage" href="/">MIOBLOG</a>
          <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
        
            <?php if (loggedIn()): ?>
              <li class="nav-item">
                <span class="nav-link" style="color: white;"><i class="fas fa-user"></i> <?= getUserName()?>&nbsp;</span>
              </li>

              <li>
                <div class="dropdown">
                  <button class="btn btn-secondary btn-sm btn-color nav-link" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars fa-lg"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-dropdown" aria-labelledby="dropdownMenuButton2">
                    <li> <a class="dropdown-item" aria-current="page" href="/posts"><i class="fas fa-home"></i> Posts</a></li>
                    <li> <a class="dropdown-item" href="/post/create"><i class="fas fa-plus"></i> New post</a></li>
                    <li> <a class="dropdown-item" href="/auth/<?=getUserId()?>/formsignup"><i class="fas fa-user-cog"></i> Edit profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item center">
                      <form action="/auth/logout" method="post">
                        <button class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </li>
              <?php else: ?>
            
              <li class="nav-item>">
                <a style="color: white;" class="btn btn-sm" href="/auth/showLogin"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a class="btn btn-success btn-sm"  href="/auth/formsignup"><i class="fas fa-user-plus"></i> Signup</a>
              </li>
            <?php endif ?>
            
          </ul>

    </div>
  </nav>
</header>


<main class="container">
  <div class="container"><br>
    <?= $this->content ?>
  </div>
</main>


<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">&copy; Mioblog <?=date('d-m-Y')?></span>
    <span style="float: right;" >Chakir Mustafa</span>
  </div>
</footer>
<script src="/js/jquery.js"></script>
<script src="/js/tether.js" ></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/all.js"></script>
    <script>
      $('.dropdown-toggle').dropdown()
    </script>
  </body>
</html>
