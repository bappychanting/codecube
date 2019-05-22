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

    <title><?php startblock('title') ?><?php endblock() ?></title>
    
    <!-- CSS-->
    <?php echo style('css/bootstrap.min.css'); ?>
    <?php echo style('plugins/iconic/css/open-iconic-bootstrap.css'); ?>

  </head>
  <!-- #ENDS# Header -->

  <body>

    <?php startblock('content') ?>
    <?php endblock() ?>

    <!-- Bootstrap tooltips -->
    <?php echo script('js/popper.min.js'); ?>
    <!-- Bootstrap core JavaScript -->
    <?php echo script('js/bootstrap.min.js'); ?>

  </body>

</html>
