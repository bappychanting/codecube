<?php inherits('layouts.master'); ?>


<?php startblock('title') ?>
	
	<?php echo title('Users'); ?>

<?php endblock() ?>

<?php startblock('users') ?>

	<?php echo image('file.jpg', 'great', ['class'=>'img-thumbnile']); ?>
	
	<br>

	<a href="<?php echo route('home', 'frontpage', ['id' => '3', 'uname'=>'bappy']); ?>">Home</a>	

	<br>	

	<?php print_r($users); ?>

<?php endblock() ?>