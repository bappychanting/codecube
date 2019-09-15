<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Items || '.$item['name'].' || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    <?php echo $item['name'] ?>
  </div>
  <div class="card-body">
    <?php 
    $alerts = Base\Request::getFlash();
    if(!empty((array) $alerts)){
      foreach($alerts as $key=>$value){
        ?>
        <div class="alert alert-<?php echo $key; ?> alert-dismissible"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $value; ?>
        </div>
        <?php                            
      }
    } 
    ?>
    <p><strong>Item Name:</strong> <?php echo $item['name']; ?></p>
    <p><strong>Item Price:</strong> <?php echo $item['price']; ?>/=</p>
    <form method="post" action="<?php echo route('items/delete') ?>" onsubmit="return confirm('Do you really want to delete this item?');">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <input type="hidden" value="<?php echo $item['id']; ?>" name="id">
      <a class="btn btn-primary" href="<?php echo route('items/all') ?>"><span class="oi oi-list pr-2"></span>All Items</a>
      <a class="btn btn-warning" href="<?php echo route('items/edit', ['id' => $item['id']]) ?>"><span class="oi oi-pencil pr-2"></span>Edit Item</a>
      <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span> Delete Item</button>
    </form>
  </div>
</div>

<?php endblock() ?>