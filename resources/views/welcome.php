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
    <?php echo icon('img/favicon.png'); ?>

    <title><?php echo 'Welcome || '.title(); ?></title>
    
    <!-- CSS-->
    <?php echo style('plugins/bootstrap/css/bootstrap.min.css'); ?>

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
        <?php echo image('resources/assets/img/logo.png', 'framework_icon', ['class'=>'framework_icon pr-3']); ?>CodeCube
      </h1>
      <p class="my-5">
        <a href="https://www.codecubeit.com/" class="mx-5">Documentation</a>
        <a href="<?php echo route('signin'); ?>" class="mx-5">Demo App</a>
        <a href="/database_migration" class="mx-5">Migration</a>
        <a href="https://www.codecubeit.com/know-us/" class="mx-5">About Us</a>
      </p> 
    </div> 

    <p class="small brand">
      <a href="https://www.codecubeit.com/" class="text-muted">codecube.com</a> 
    </p> 

    <!-- Bootstrap tooltips -->
    <?php echo script('plugins/bootstrap/js/popper.min.js'); ?>
    <!-- Bootstrap core JavaScript -->
    <?php echo script('plugins/bootstrap/js/bootstrap.min.js'); ?>

  </body>

</html>