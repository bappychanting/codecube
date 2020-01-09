<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Log In || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Sign In
  </div>
  <div class="card-body">
    <?php if(!empty(Base\Request::getData('timeout'))){ ?>
      <div class="alert alert-danger"><?php echo Base\Request::getData('timeout'); ?></div>
      <h5 class="card-title">Spam Protection</h5>
      <p class="text-secondary"><?php echo Base\Request::show('captcha')->number1.' + '. Base\Request::show('captcha')->number2.' = ?'; ?></p>
      <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-block bg-red waves-effect"><span class="oi oi-reload pr-2"></span> <span class="icon-name">ReCaptcha</span></a>
      <form method="POST" action="<?php echo route('captcha'); ?>">            
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
          <label for="email">Captcha:</label>
          <input type="text" class="form-control" name="check" placeholder="Enter captcha text" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    <?php } else{ ?>
      <form method="POST" action="<?php echo route('login'); ?>">            
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
          <h5 class="card-title">Please Input Your Login Credentials</h5>
        <?php } ?>
        <div class="form-group">
          <label for="username">Username/Email address:</label>
          <input type="text" id="username" class="form-control" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" class="form-control" name="password">
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="remember">
          <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary mr-5">Submit</button>
        <a href="<?php echo route('password/forgot'); ?>">Forgot Password?</a>
      </form>
    <?php  } ?>
  </div>
</div>

<?php endblock() ?>