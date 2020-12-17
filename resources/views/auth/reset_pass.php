<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Reset Password || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Reset Password
  </div>
  <div class="card-body">
      <h5 class="card-title">Enter Your New Password, <?php echo $link['name']; ?></h5>

      <form method="POST" action="<?php echo route('password/update'); ?>"> 

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="id" value="<?php echo $link['user_id']; ?>">
        <input type="hidden" name="token" value="<?php echo $link['token']; ?>">
        
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

        <button type="submit" class="btn btn-primary mr-5">Reset</button>
      </form>
  </div>
</div>

<?php endblock() ?>