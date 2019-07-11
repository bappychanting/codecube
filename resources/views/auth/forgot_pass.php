<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Forgot Password || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Forgot Password
  </div>
  <div class="card-body">
    <?php 
    $alerts = Base\Request::getFlash();
    if(!empty((array) $alerts)){
      foreach($alerts as $key=>$value){
        ?>
        <div class="alert alert-<?php echo $key; ?>"> 
          <?php echo $value; ?>
        </div>
        <?php                            
      }
    } 
    else { ?> 
      <form method="POST" action="<?php echo route('password/mail'); ?>">            
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <h5 class="card-title">Please Input Your Username/Email address</h5>
        <div class="form-group">
          <input type="text" class="form-control" name="credential">
        </div>
        <button type="submit" class="btn btn-primary mr-5">Submit</button>
      </form>
    <?php } ?>
  </div>
</div>

<?php endblock() ?>