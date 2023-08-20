<?php inherits('app') ?>

<?php startblock('title') ?>

<?= 'Items || '.$item['name'].' || Edit Item || '.title() ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Edit <?= $item['name'] ?>
  </div>
  <div class="card-body">

      <form method="POST" action="<?= route('items/update') ?>"> 

        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

        <input type="hidden" name="id" value="<?= $item['id'] ?>">
        
        <div class="form-label-group my-3">
          <label for="inputName">Name</label>
          <input type="text" name="name" value="<?= $item['name'] ?>" id="inputName" class="form-control <?= empty(field_err('name'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('name'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('name') ?></strong>
          </span>
          <?php } ?>
        </div>
        
        <div class="form-label-group my-3">
          <label for="inputPrice">Price</label>
          <input type="number" step="0.01" value="<?= $item['price'] ?>" name="price" id="inputPrice" class="form-control <?= empty(field_err('price'))? '' : 'is-invalid' ?>">
          <?php if(!empty(field_err('price'))){ ?>
          <span class="invalid-feedback" role="alert">
            <strong><?= field_err('price') ?></strong>
          </span>
          <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary mr-5">Update</button>
      </form>

      <a href="<?= route('items/show/{id}', ['id' => $item['id']]) ?>" class="btn btn-primary btn-sm my-3"><span class="oi oi-arrow-left pr-2"></span>Go Back</a>

  </div>
</div>

<?php endblock() ?>