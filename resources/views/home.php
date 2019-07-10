<?php inherits('app'); ?>

<?php startblock('title') ?>

<?php echo 'Home || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">
    Dashboard
  </div>
  <div class="card-body">
    <h3 class="text-center my-5 text-muted">
    	<span class="oi oi-dashboard pr-2"></span>
    	Welcome to dashboard!
    </h3>
  </div>
</div>

<?php endblock() ?>