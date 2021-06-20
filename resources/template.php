
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title >The home page of Alphablog</title>   
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
  
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">ALPHABLOG</a>
        <ul class="nav navbar-nav ">
           <!--  <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/posts">Posts</a>
            </li> -->
            <?php if (loggedIn()): ?>
            
          <?php endif ?>
          </ul>
          <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
        
            <?php if (loggedIn()): ?>
              <li class="nav-item">
                <p class="nav-link" style="color: white;">Welcome <?= getUserName()?>&nbsp;</p>
              </li>
              <li>
                <div class="dropdown">
                  <button class="btn btn-secondary btn-sm dropdown-toggle nav-link" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li> <a class="dropdown-item" aria-current="page" href="/posts">Posts</a></li>
                    <li> <a class="dropdown-item" href="/post/create">New Post</a></li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item center">
                      <form action="/auth/logout" method="post">
                        <button class="dropdown-item">Logout</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </li>
              <?php else: ?>
            
              <li class="nav-item>">
                <a class="btn btn-success btn-sm" href="/auth/showLogin">Login</a>
                <a class="btn btn-info btn-sm"  href="/auth/formsignup">Signup</a>
              </li>
            <?php endif ?>
            
          </ul>

        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="container">
  <div class="container"><br>
    <?= $this->content ?>
  </div>
</main>


<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>
<script src="/js/jquery.js"></script>
<script src="/js/tether.js" ></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
      $('.dropdown-toggle').dropdown()
    </script>
  </body>
</html>
