<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    <!-- You have to yield meta here -->

    <!-- Favicon-->
    <?php echo icon('https://www.iconbros.com/assets/logo-ba988fad672f61d8a4b9a2ce7707c5ade6c868d2c99af49e74a815200dac0044.png'); ?>

    <title><?php startblock('title') ?><?php endblock() ?></title>
    
    <!-- CSS-->
    <?php append('layouts.partials.styles'); ?>

  </head>
  <!-- #ENDS# Header -->

  <body>

    <?php startblock('users') ?>
    <?php endblock() ?>

  	<!-- Javascript -->
    <?php append('layouts.partials.scripts'); ?>
  </body>

</html>
