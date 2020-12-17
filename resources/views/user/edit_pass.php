<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Account || '.$user['name'].' || Edit Password || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Edit Password
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
    ?>

    <form method="POST" action="<?php echo route('user/update/password'); ?>"> 

      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

      <div class="form-label-group my-3">
        <label for="inputAuthPass">Old Password</label>
        <input type="password" name="auth_pass" id="inputAuthPass" class="form-control">
      </div>

      <div class="form-label-group my-3">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control <?php echo empty(field_err('password'))? '' : 'is-invalid'; ?>">
        <?php if(!empty(field_err('password'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo field_err('password'); ?></strong>
          </span>
        <?php } ?>
      </div>

      <div class="form-label-group my-3">
        <label for="inputConfirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="inputConfirmPassword" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary mr-5">Update</button>
    </form>

    <a href="<?php echo route('user/show') ?>" class="btn btn-primary btn-sm my-3"><span class="oi oi-arrow-left pr-2"></span>Go Back</a>

  </div>
</div>

<?php endblock() ?>