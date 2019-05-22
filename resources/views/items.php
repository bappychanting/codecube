<?php inherits('app'); ?>

<?php startblock('title') ?>
    
    <?php echo 'Welcome || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>
    
    <div class="text-center">
      <h1 class="my-5 text-secondary">
        <?php echo image('resources/assets/img/logo.png', 'framework_icon', ['class'=>'framework_icon pr-3']); ?>CodeCube
      </h1>
      <p class="my-5">
        <a href="https://www.codecubeit.com/" class="mx-5"><span class="oi oi-document pr-3"></span>Documentation</a>
        <a href="<?php echo route('login'); ?>" class="mx-5"><span class="oi oi-terminal pr-3"></span>Demo App</a>
        <a href="https://www.codecubeit.com/know-us/" class="mx-5"><span class="oi oi-info pr-3"></span>About Us</a>
      </p> 
    </div> 

    <p class="small brand">
      <a href="https://www.codecubeit.com/" class="text-muted">codecube.com</a> 
    </p> 

<?php endblock() ?>