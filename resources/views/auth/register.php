<?php inherits('app'); ?>

<?php startblock('title') ?>
    
    <?php echo 'Register || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>
      <div class="card">
        <div class="card-header">
          Register
        </div>
        <div class="card-body">
            <form class="form-signin">

              <div class="form-label-group my-3">
                <label for="inputName">Name</label>
                <input type="name" id="inputName" class="form-control" autofocus>
              </div>

              <div class="form-label-group my-3">
                <label for="inputUsername">Username</label>
                <input type="email" id="inputUsername" class="form-control">
              </div>

              <div class="form-label-group my-3">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control">
              </div>

              <div class="form-label-group my-3">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control">
              </div>

              <div class="form-label-group my-3">
                <label for="inputConfirmPassword">Confirm Password</label>
                <input type="password" id="inputConfirmPassword" class="form-control">
              </div>

              <button class="btn btn-primary text-uppercase" type="submit">Register</button>
            </form>
        </div>
      </div>

<?php endblock() ?>