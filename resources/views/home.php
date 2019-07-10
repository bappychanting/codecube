<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Home || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Dashboard
  </div>
  <div class="card-body">
    <?php 
    $alerts = Base\Request::getFlash();
    if(!empty((array) $alerts)){
      foreach($alerts as $key=>$value){
        ?>
        <div class="alert alert-<?php echo $key; ?> alert-dismissible"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $value; ?>
        </div>
        <?php                            
      }
    } 
    ?>
    <h3 class="text-center my-5 text-muted">
    	<span class="oi oi-dashboard pr-2"></span>
    	Welcome to dashboard!
    </h3>
  </div>
</div>

<?php endblock() ?>