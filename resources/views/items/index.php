<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Items || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Items
    <?= $gay ?>
  </div>
  <div class="card-body">
    <a class="btn btn-primary mb-3" href="<?= route('items/create') ?>"><span class="oi oi-plus pr-2"></span> Add New Item</a>
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
          <th scope="row"><?= $count ?></th>
          <td><?= $item['name'] ?></td>
          <td><?= $item['price'] ?></td>
          <td>
            <form method="post" action="<?= route('items/delete') ?>" onsubmit="return confirm('Do you really want to delete this item?');">
              <input type="hidden" name="_token" value="<?= csrf_token() ?>">
              <input type="hidden" value="<?= $item['id'] ?>" name="id">
              <a class="btn btn-primary" href="<?= route('items/show/{id}', ['id' => $item['id']]) ?>"><span class="oi oi-eye"></span></a>
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
    <?= $items['pagination'] ?>
  </div>
</div>

<?php endblock() ?>