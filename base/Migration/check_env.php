<?php 

header('Content-type: application/json');

if(file_exists('../../env.php')){

	require_once('../../env.php');

	$app['name'] = APP_NAME;

	$app['env'] = APP_ENV;

	echo json_encode($app);
}

?>