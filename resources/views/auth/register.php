<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Register || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-header">
    Register
  </div>
  <div class="card-body">
    <form class="form-signin" action="<?= route('register') ?>" method="POST">

      <input type="hidden" name="_token" value="<?= csrf_token() ?>">

        <div class="form-label-group my-3">
          <label for="inputName">Name</label>
          <input type="text" name="name" value="<?= field_val('name') ?>" id="inputName" class="form-control <?= empty(field_err('name'))? '' : 'is-invalid' ?>" autofocus>
          <?php if(!empty(field_err('name'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('name') ?></strong>
          </span>
          <?php } ?>
        </div> 

        <div class="form-label-group my-3">
          <label for="inputUsername">Username</label>
          <input type="text" name="username" value="<?= field_val('username') ?>" id="inputUsername" class="form-control <?= empty(field_err('username'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('username'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('username') ?></strong>
          </span>
          <?php } ?>
        </div>

        <div class="form-label-group my-3">
          <label for="inputEmail">Email address</label>
          <input type="email" name="email" value="<?= field_val('email') ?>" id="inputEmail" class="form-control <?= empty(field_err('email'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('email'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('email') ?></strong>
          </span>
          <?php } ?>
        </div>

        <div class="form-label-group my-3">
          <label for="inputPassword">Password</label>
          <input type="password" name="password" id="inputPassword" class="form-control <?= empty(field_err('password'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('password'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('password') ?></strong>
          </span>
          <?php } ?>
        </div>

        <div class="form-label-group my-3">
          <label for="inputConfirmPassword">Confirm Password</label>
          <input type="password" name="confirmPassword" id="inputConfirmPassword" class="form-control">
        </div>

        <button class="btn btn-primary text-uppercase" type="submit">Register</button>
      </form>
    </div>
  </div>

  <?php endblock() ?>