<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>

    <meta charset="UTF-8">
    <meta name="description" content="CodeCube Framework">
    <meta name="keywords" content="PHP,HTML,CSS,XML,JavaScript">
    <meta name="author" content="Mahadi Hasan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon-->
    <?= icon('img/favicon.png') ?>

    <title><?= 'Welcome || '.title() ?></title>
    
    <!-- CSS-->
    <?= style('plugins/bootstrap/css/bootstrap.min.css') ?>

    <style>
      body {
          background-color: #f2f2f2;
      }
      a:link {
          text-decoration: none;
      }
      .brand {  
        position:absolute;
        bottom:0px;
        right:25%;
        left:50%;
      }
      .framework_icon{
        height: 60px;
      }
    </style>

  </head>
  <!-- #ENDS# Header -->

  <body>
    
    <div class="text-center">
      <h1 class="my-5 text-secondary">
        <?= image('resources/assets/img/logo.png', 'framework_icon', ['class'=>'framework_icon pr-3']) ?>CodeCube
      </h1>
      <p class="my-5">
        <a href="https://codecube.readthedocs.io/" target="_blank" class="mx-5">Documentation</a>
        <a href="/signin" class="mx-5">Demo App</a>
        <a href="https://github.com/bappychanting/codecube" target="_blank" class="mx-5">Github</a>
        <a href="https://bappychanting.wordpress.com/" target="_blank" class="mx-5">About Developer</a>
      </p> 
    </div> 

    <!-- Bootstrap tooltips -->
    <?= script('plugins/bootstrap/js/popper.min.js') ?>
    <!-- Bootstrap core JavaScript -->
    <?= script('plugins/bootstrap/js/bootstrap.min.js') ?>

  </body>

</html>