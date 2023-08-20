<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Account || '.$user['name'].' || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    <?= $user['name'] ?>
  </div>
  <div class="card-body">
    <?php 
      $alerts = Base\Request::getFlash();
      if(!empty((array) $alerts)){
        foreach($alerts as $key=>$value){
          ?>
          <div class="alert alert-<?= $key ?> alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $value ?>
          </div>
          <?php                            
        }
      } 
    ?>
    <p><strong>Userame:</strong> <?= $user['username'] ?></p>
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <a class="btn btn-warning" href="<?= route('user/edit') ?>"><span class="oi oi-pencil pr-2"></span>Edit Details</a>
    <a class="btn btn-warning" href="<?= route('user/edit/password') ?>"><span class="oi oi-pencil pr-2"></span>Edit Password</a>
  </div>
</div>

<?php endblock() ?>