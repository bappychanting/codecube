<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Items || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Items
  </div>
  <div class="card-body">
    <a class="btn btn-primary mb-3" href="<?php echo route('items/create') ?>"><span class="oi oi-plus pr-2"></span> Add New Item</a>
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
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
<?php   
    $count = 1;
    foreach($items['items'] as $item) { 
?>
        <tr>
          <th scope="row"><?php echo $count ?></th>
          <td><?php echo $item['name'] ?></td>
          <td><?php echo $item['price'] ?></td>
          <td>
            <form method="post" action="<?php echo route('items/delete') ?>" onsubmit="return confirm('Do you really want to delete this item?');">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" value="<?php echo $item['id']; ?>" name="id">
              <a class="btn btn-primary" href="<?php echo route('items/show', ['id' => $item['id']]) ?>"><span class="oi oi-eye"></span></a>
              <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
            </form>
          </td>
        </tr>
<?php   
        $count++;   
    }
?>
      </tbody>
    </table>
    <?php echo $items['pagination']; ?>
  </div>
</div>

<?php endblock() ?>