<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Items || Add New Item || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Add New Item
  </div>
  <div class="card-body">

      <form method="POST" action="<?php echo route('items/store'); ?>"> 

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <input type="hidden" name="user_id" value="<?php echo $auth_user->id; ?>">
        
        <div class="form-label-group my-3">
          <label for="inputName">Name</label>
          <input type="text" name="name" value="<?php echo field_val('name'); ?>" id="inputName" class="form-control <?php echo empty(field_err('name'))? '' : 'is-invalid'; ?>">
          <?php if(!empty(field_err('name'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo field_err('name'); ?></strong>
          </span>
          <?php } ?>
        </div>
        
        <div class="form-label-group my-3">
          <label for="inputPrice">Price</label>
          <input type="number" step="0.01" value="<?php echo field_val('price'); ?>" name="price" id="inputPrice" class="form-control <?php echo empty(field_err('price'))? '' : 'is-invalid'; ?>">
          <?php if(!empty(field_err('price'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo field_err('price'); ?></strong>
          </span>
          <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary mr-5">Submit</button>
      </form>

      <a href="<?php echo route('items/all') ?>" class="btn btn-primary btn-sm my-3"><span class="oi oi-arrow-left pr-2"></span>Go Back</a>
  </div>
</div>

<?php endblock() ?>