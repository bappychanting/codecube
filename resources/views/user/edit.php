<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Account || '.$user['name'].' || Edit Details || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Edit Details
  </div>
  <div class="card-body">

      <form method="POST" action="<?= route('user/update') ?>"> 

        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        <div class="form-label-group my-3">
          <label for="inputName">Name</label>
          <input type="text" name="name" value="<?= $user['name'] ?>" id="inputName" class="form-control <?= empty(field_err('name'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('name'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('name') ?></strong>
          </span>
          <?php } ?>
        </div>
        
        <div class="form-label-group my-3">
          <label for="inputUserame">Username</label>
          <input type="text" name="username" value="<?= $user['username'] ?>" id="inputUserame" class="form-control <?= empty(field_err('username'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('username'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('username') ?></strong>
          </span>
          <?php } ?>
        </div>
        
        <div class="form-label-group my-3">
          <label for="inputEmail">Email</label>
          <input type="email" value="<?= $user['email'] ?>" name="email" id="inputEmail" class="form-control <?= empty(field_err('email'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('email'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('email') ?></strong>
          </span>
          <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary mr-5">Update</button>
      </form>

      <a href="<?= route('user/show') ?>" class="btn btn-primary btn-sm my-3"><span class="oi oi-arrow-left pr-2"></span>Go Back</a>

  </div>
</div>

<?php endblock() ?>