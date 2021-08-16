<?php 
namespace App\views;
use App\Core\Application; 

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if(Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                 <?php echo Application::$app->session->getFlash('success'); ?>
            </div>
         <?php endif; ?>

        {{content}}
    </div>
    
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/assets/js/jquery.min.js"  crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  </body>
</html>
