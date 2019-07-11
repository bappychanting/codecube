<?php 

header('Content-type: application/json');

$messages = array();

if(file_exists('../../env.php')){

	require_once('../../env.php');

	if(APP_ENV == 'dev' && !empty($_POST['app-key']) && $_POST['app-key'] == APP_KEY){

		$con=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

			// Check connection
		if (mysqli_connect_errno()){
			array_push($messages, "Error: Failed to connect to MySQL! " . mysqli_connect_error());
		}

		if(isset($_POST['reset_migration']) && $_POST['reset_migration'] == "reset"){
			$status = mysqli_query($con, "DROP TABLE IF EXISTS `migrations`");
			if($status){
				array_push($messages, 'Success: Existing Migration table has been removed!');
			}
		}

		$check_migration = mysqli_query($con, 'SHOW TABLES LIKE "migrations"');

		if(mysqli_num_rows($check_migration) == 0){
			$status = mysqli_query($con, "CREATE TABLE `migrations` (
							`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							`migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`batch` int(11) NOT NULL DEFAULT '0',
							PRIMARY KEY (`id`)
						)");
			if($status){
				array_push($messages, 'Success: Migration table has been created!');
			}
		}

		$migrations = mysqli_query($con, "SELECT * FROM `migrations`");
		$all_keys = array();
		while ($migration = mysqli_fetch_assoc($migrations))
	   	{
			array_push($all_keys, $migration['migration']);
	   	}

			// Include Queries
		foreach (glob("../../database/*.php") as $files){

		    $queries = include $files;

		    foreach ($queries as $key=>$value){
		    	if(in_array($key, $all_keys)){
			    	array_push($messages, 'Warning: Migration `'.ucwords(str_replace("_", " ", $key)).'` already exists! Migration skipped.');
		    	}
		    	else{
		    			// Execute Query
					$status = mysqli_query($con, $value);
			        if($status){
			        	mysqli_query($con, 'INSERT INTO migrations (migration, batch) VALUES ("'.$key.'", '.time().')');
			        	array_push($messages, 'Success: Query `'.ucwords(str_replace("_", " ", $key)).'` executed successfully!');
			        }
			        else{
			        	array_push($messages, 'Error: Query `'.ucwords(str_replace("_", " ", $key)).'` failed! Reason: '.mysqli_error($con));
			        }   
		    	}
		    }
		}

		mysqli_close($con);
	}
	else{
		array_push($messages, 'Error: Mismatched values in project environment configuration!');
	}
}
else{
	array_push($messages, 'Error: Project environment configuration file not found!');
}

echo json_encode($messages);


?>