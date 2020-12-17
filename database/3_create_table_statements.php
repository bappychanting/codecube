<?php

return [

		// Create users

	'create_users' => 	"CREATE TABLE `users` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`attempts` int(11) DEFAULT NULL,
							`login_token` varchar(255) DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
							UNIQUE KEY `users_username_unique` (`username`),
							UNIQUE KEY `users_email_unique` (`email`)
						)",

		// Create reset password links

	'create_reset_password_links' =>	"CREATE TABLE `reset_password_links` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`validity` tinyint(4) NOT NULL DEFAULT '1',
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `reset_password_link_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create items

	'create_items' => 	"CREATE TABLE `items` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    						`price` DECIMAL(8,2) NOT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `create_item_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",	
];