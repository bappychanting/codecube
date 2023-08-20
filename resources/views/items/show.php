<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Items || '.$item['name'].' || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    <?= $item['name'] ?>
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
    <p><strong>Item Name:</strong> <?= $item['name'] ?></p>
    <p><strong>Item Price:</strong> <?= $item['price'] ?>/=</p>
    <form method="post" action="<?= route('items/delete') ?>" onsubmit="return confirm('Do you really want to delete this item?');">
      <input type="hidden" name="_token" value="<?= csrf_token() ?>">
      <input type="hidden" value="<?= $item['id'] ?>" name="id">
      <a class="btn btn-primary" href="<?= route('items/all') ?>"><span class="oi oi-list pr-2"></span>All Items</a>
      <a class="btn btn-warning" href="<?= route('items/edit/{id}', ['id' => $item['id']]) ?>"><span class="oi oi-pencil pr-2"></span>Edit Item</a>
      <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span> Delete Item</button>
    </form>
  </div>
</div>

<?php endblock() ?>