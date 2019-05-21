<?php

return [

		// Create web contents

	'create_web_contents' => 	"CREATE TABLE `web_contents` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`content_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`content` longtext COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create gallery

	'create_gallery' => 	"CREATE TABLE `gallery` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create files

	'create_files' => 	"CREATE TABLE `files` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create users

	'create_users' => 	"CREATE TABLE `users` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`dob` datetime DEFAULT NULL,
							`contact` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
							`designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`address` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`gender` tinyint(4) NOT NULL DEFAULT '0',
							`role` tinyint(4) NOT NULL DEFAULT '3',
							`avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
							`attempts` int(11) DEFAULT NULL,
							`timestamp` int(11) DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
							UNIQUE KEY `users_username_unique` (`username`),
							UNIQUE KEY `users_email_unique` (`email`),
							UNIQUE KEY `users_contact_unique` (`contact`)
						)",

		// Create reset password links

	'create_reset_password_links' =>	"CREATE TABLE `reset_password_links` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`validity` tinyint(4) NOT NULL DEFAULT '1',
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							CONSTRAINT `reset_password_link_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",


		// Create students

	'create_students' => 	"CREATE TABLE `students` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`father_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`mother_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`guardian_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`permanent_address` varchar(255) COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `student_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create student files

	'create_student_files' => 	"CREATE TABLE `student_files` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`student_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `student_id` (`student_id`),
							CONSTRAINT `file_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create teachers

	'create_teachers' => 	"CREATE TABLE `teachers` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`teacher_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `teacher_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create accountants

	'create_accountants' => 	"CREATE TABLE `accountants` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`accountant_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `accountants_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",


		// Create blog category

	'create_blog_categories' =>	"CREATE TABLE `blog_categories` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`category_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create blog

	'create_blogs' => 	"CREATE TABLE `blogs` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`title` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  							`tags` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`image_path` varchar(255) COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  							`details` longtext COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`approval` tinyint(1) NOT NULL DEFAULT '0',
  							`views` int(11) NOT NULL DEFAULT '0',
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`category_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `category_id` (`category_id`),
  							CONSTRAINT `blog_category_id` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `blog_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create periods

	'create_periods' => 	"CREATE TABLE `periods` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`start_time` time DEFAULT NULL,
  							`end_time` time DEFAULT NULL,
  							`extend_start_time` int(3) unsigned DEFAULT NULL,
  							`extend_end_time` int(3) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create grades

	'create_grades' => 	"CREATE TABLE `grades` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create sessions

	'create_sessions' => 	"CREATE TABLE `sessions` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  							`start_date` date DEFAULT NULL,
  							`end_date` date DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create classrooms

	'create_classrooms' => 	"CREATE TABLE `classrooms` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create subjects

	'create_subjects' => 	"CREATE TABLE `subjects` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create sections

	'create_sections' => 	"CREATE TABLE `sections` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create attendance

	'create_attendances' => 	"CREATE TABLE `attendances` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`attendance_date` timestamp NULL,
  							`students` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  							`grade_id` int(11) unsigned DEFAULT NULL,
  							`section_id` int(11) unsigned DEFAULT NULL,
  							`session_id` int(11) unsigned DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `grade_id` (`grade_id`),
  							KEY `section_id` (`section_id`),
  							KEY `session_id` (`session_id`),
  							KEY `user_id` (`user_id`),
  							CONSTRAINT `attendance_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `attendance_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `attendance_session_id` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `attendance_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create exam category

	'create_exam_categories' =>	"CREATE TABLE `exam_categories` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create exams

	'create_exams' => 	"CREATE TABLE `exams` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`grade_id` int(11) unsigned DEFAULT NULL,
  							`section_id` int(11) unsigned DEFAULT NULL,
  							`session_id` int(11) unsigned DEFAULT NULL,
  							`category_id` int(11) unsigned DEFAULT NULL,
  							`subject_id` int(11) unsigned DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`title` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`exam_date` date NULL DEFAULT NULL,
  							`exam_time` time NULL DEFAULT NULL,
  							`duration` tinyint(4) NOT NULL DEFAULT '0',
  							`total_marks` tinyint(4) NOT NULL DEFAULT '0',
  							`details` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`approval` tinyint(1) NOT NULL DEFAULT '0',
  							`student_marks` text COLLATE utf8_unicode_ci NULL DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `grade_id` (`grade_id`),
  							KEY `section_id` (`section_id`),
  							KEY `session_id` (`session_id`),
  							KEY `category_id` (`category_id`),
  							KEY `subject_id` (`subject_id`),
  							CONSTRAINT `exam_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `exam_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `exam_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `exam_session_id` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `exam_category_id` FOREIGN KEY (`category_id`) REFERENCES `exam_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `exam_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create schedules

	'create_schedules' => 	"CREATE TABLE `schedules` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`grade_id` int(11) unsigned DEFAULT NULL,
  							`section_id` int(11) unsigned DEFAULT NULL,
  							`session_id` int(11) unsigned DEFAULT NULL,
  							`subject_id` int(11) unsigned DEFAULT NULL,
  							`scheduled_days` text COLLATE utf8_unicode_ci NOT NULL,
  							`period_id` int(11) unsigned DEFAULT NULL,
  							`start_time` time DEFAULT NULL,
  							`end_time` time DEFAULT NULL,
  							`teacher_id` int(11) unsigned DEFAULT NULL,
  							`classroom_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `grade_id` (`grade_id`),
  							KEY `section_id` (`section_id`),
  							KEY `session_id` (`session_id`),
  							KEY `subject_id` (`subject_id`),
  							KEY `period_id` (`period_id`),
  							KEY `teacher_id` (`teacher_id`),
  							KEY `classroom_id` (`classroom_id`),
							CONSTRAINT `schedule_session_id` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_period_id` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `schedule_classroom_id` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create education archive

	'create_education_archive' => 	"CREATE TABLE `education_archive` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`session_id` int(11) unsigned DEFAULT NULL,
  							`grade_id` int(11) unsigned DEFAULT NULL,
  							`section_id` int(11) unsigned DEFAULT NULL,
  							`student_id` int(11) unsigned DEFAULT NULL,
  							`roll` int(11) DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `session_id` (`session_id`),
  							KEY `grade_id` (`grade_id`),
  							KEY `section_id` (`section_id`),
  							KEY `student_id` (`student_id`),
							CONSTRAINT `education_archive_session_id` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `education_archive_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `education_archive_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `education_archive_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create accounting categories

	'create_accounting_categories' => 	"CREATE TABLE `accounting_categories` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create accountings

	'create_accountings' => 	"CREATE TABLE `accountings` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`description` mediumtext COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    						`target` enum('User', 'Class') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
    						`amount` DECIMAL(8,2) NOT NULL,
  							`due_date` date DEFAULT NULL,
							`yearly` tinyint(1) NOT NULL DEFAULT '0',
  							`category_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `category_id` (`category_id`),
  							CONSTRAINT `accounting_category_id` FOREIGN KEY (`category_id`) REFERENCES `accounting_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create grade accountings 

	'create_grade_accountings' => 	"CREATE TABLE `grade_accountings` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`grade_id` int(11) unsigned DEFAULT NULL,
  							`accounting_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `grade_id` (`grade_id`),
  							KEY `accounting_id` (`accounting_id`),
  							CONSTRAINT `grade_accounting_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `grade_accounting_accounting_id` FOREIGN KEY (`accounting_id`) REFERENCES `accountings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create user accountings

	'create_user_accountings' => 	"CREATE TABLE `user_accountings` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`accounting_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `accounting_id` (`accounting_id`),
  							CONSTRAINT `user_accountings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `user_accountings_accounting_id` FOREIGN KEY (`accounting_id`) REFERENCES `accountings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create transactions

	'create_transactions' => 	"CREATE TABLE `transactions` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`accounting_id` int(11) unsigned DEFAULT NULL,
  							`accountant_id` int(11) unsigned DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
    						`transaction_type` enum('Paying','Receiving') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paying',
    						`transaction_amount` DECIMAL(8,2) NOT NULL,
							`comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `accounting_id` (`accounting_id`),
  							KEY `user_id` (`user_id`),
  							KEY `accountant_id` (`accountant_id`),
  							CONSTRAINT `transaction_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `transaction_accountant_id` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  							CONSTRAINT `transaction_accounting_id` FOREIGN KEY (`accounting_id`) REFERENCES `accountings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create message subjects

	'create_message_subjects' => 	"CREATE TABLE `message_subjects` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`subject_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create messages

	'create_messages' => 	"CREATE TABLE `messages` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							`message_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`message_subject_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `message_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `message_message_subject_id` FOREIGN KEY (`message_subject_id`) REFERENCES `message_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",


		// Create message participants

	'create_message_participants' => 	"CREATE TABLE `message_participants` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`message_subject_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `message_subject_id` (`message_subject_id`),
							CONSTRAINT `message_participant_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `message_participant_message_subject_id` FOREIGN KEY (`message_subject_id`) REFERENCES `message_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create message viewers

	'create_message_viewers' => 	"CREATE TABLE `message_viewers` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`message_id` int(11) unsigned DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `message_id` (`message_id`),
							CONSTRAINT `message_viewers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `message_viewers_message_id` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create notices

	'create_notices' => 	"CREATE TABLE `notices` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`notice` mediumtext COLLATE utf8_unicode_ci NOT NULL,
							`broadcast` tinyint(4) NOT NULL DEFAULT '1',
  							`expiration` date DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)",

		// Create notice receiver

	'create_notice_receivers' => 	"CREATE TABLE `notice_receivers` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`notice_id` int(11) unsigned DEFAULT NULL,
  							`user_id` int(11) unsigned DEFAULT NULL,
							`total_sent` int NULL DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
  							KEY `notice_id` (`notice_id`),
							CONSTRAINT `notice_receiver_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
							CONSTRAINT `notice_receiver_notice_id` FOREIGN KEY (`notice_id`) REFERENCES `notices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",

		// Create notifications

	'create_notifications' => 	"CREATE TABLE `notifications` (
							`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  							`user_id` int(11) unsigned DEFAULT NULL,
  							`notification` mediumtext COLLATE utf8_unicode_ci NOT NULL,
							`read_at` timestamp NULL DEFAULT NULL,
							`created_at` timestamp NULL DEFAULT NULL,
							`updated_at` timestamp NULL DEFAULT NULL,
							`deleted_at` timestamp NULL DEFAULT NULL,
							PRIMARY KEY (`id`),
  							KEY `user_id` (`user_id`),
							CONSTRAINT `notifications_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						)",
];