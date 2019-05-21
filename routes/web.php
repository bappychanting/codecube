<?php

return [

		/* 
		*	Declaring all route urls
		*	Make sure there is no slash (/) at the end of the route key string
		*	Each route url key must contain a class and and a method referenced with "@" as value
		*/

		// public pages

	'home' => 'HomeController@home',
	
	'gallery' => 'HomeController@gallery',

	'about' => 'HomeController@about',
	
	'contact' => 'HomeController@contact',

	'blog' => 'BlogController@index',

	'blog/show' => 'BlogController@show',
	
	'info' => 'HomeController@getInfo',

		// admin sign in pages

	'admin/login' => 'Admin/AuthController@login',

	'admin/captcha' => 'Admin/AuthController@checkCaptcha',

	'admin/signin' => 'Admin/AuthController@signin',

	'admin/password/forgot' => 'Admin/AuthController@forgotPassword',

	'admin/password/mail' => 'Admin/AuthController@sendResetInfo',

	'admin/password/reset' => 'Admin/AuthController@resetPassword',

	'admin/password/update' => 'Admin/AuthController@updatePassword',

	'admin/signout' => 'Admin/AuthController@signout',

		// admin Information pages

	'admin/dashboard' => 'Admin/HomeController@dashboard',

	'admin/search' => 'Admin/HomeController@search',

	'admin/feedback' => 'Admin/HomeController@feedback',

	'admin/class_schedule' => 'Admin/HomeController@schedule',

	'admin/class_schedule/pdf' => 'Admin/HomeController@schedulePdf',

	'admin/upcoming_exams' => 'Admin/HomeController@upcomingExams',

	'admin/user_notices' => 'Admin/HomeController@notices',

	'admin/billing' => 'Admin/HomeController@billing',

	'admin/billing/details' => 'Admin/HomeController@billingDetails',

		// admin Domain Information pages

	'admin/domains/index' => 'Admin/DomainController@index',

	'admin/domains/show' => 'Admin/DomainController@show',

	'admin/domains/messaging' => 'Admin/DomainController@sendMessage',

	'admin/domains/billings' => 'Admin/DomainController@billings',

	'admin/domains/billings/details' => 'Admin/DomainController@billingDetails',

		// admin Contents pages

	'admin/contents/home' => 'Admin/ContentController@home',

	'admin/contents/about_us' => 'Admin/ContentController@about_us',

	'admin/contents/contact_us' => 'Admin/ContentController@contact_us',

	'admin/contents/image/upload' => 'Admin/ContentController@imageUpload',

	'admin/contents/update' => 'Admin/ContentController@update',

		// admin Gallery pages

	'admin/gallery/all' => 'Admin/GalleryController@index',

	'admin/gallery/store' => 'Admin/GalleryController@store',

	'admin/gallery/delete' => 'Admin/GalleryController@delete',

		// admin notifications pages

	'admin/notifications/new' => 'Admin/NotificationController@newNotifications',

	'admin/notifications/all' => 'Admin/NotificationController@index',

	'admin/notifications/read' => 'Admin/NotificationController@maskAsRead',

		// admin message pages

	'admin/messages/new' => 'Admin/MessageController@newMessages',

	'admin/messages/all' => 'Admin/MessageController@index',

	'admin/messages/create' => 'Admin/MessageController@create',

	'admin/messages/store' => 'Admin/MessageController@store',

	'admin/messages/show' => 'Admin/MessageController@show',

	'admin/messages/edit' => 'Admin/MessageController@edit',

	'admin/messages/update' => 'Admin/MessageController@update',

	'admin/messages/message/add' => 'Admin/MessageController@addMessage',

	'admin/messages/user/include' => 'Admin/MessageController@addUser',

	'admin/messages/user/remove' => 'Admin/MessageController@removeUser',

	'admin/messages/search' => 'Admin/MessageController@search',

		// admin blog pages

	'admin/blogs/all' => 'Admin/BlogController@index',

	'admin/blogs/create' => 'Admin/BlogController@create',

	'admin/blogs/store' => 'Admin/BlogController@store',

	'admin/blogs/show' => 'Admin/BlogController@show',

	'admin/blogs/edit' => 'Admin/BlogController@edit',

	'admin/blogs/update' => 'Admin/BlogController@update',

	'admin/blogs/update/image' => 'Admin/BlogController@updateImage',

	'admin/blogs/approve' => 'Admin/BlogController@approve',

	'admin/blogs/delete' => 'Admin/BlogController@delete',

	'admin/blogs/categories/all' => 'Admin/BlogController@allCategories',

	'admin/blogs/categories/get' => 'Admin/BlogController@categories',

	'admin/blogs/categories/store' => 'Admin/BlogController@storeCategory',

	'admin/blogs/categories/update' => 'Admin/BlogController@updateCategory',

	'admin/blogs/categories/delete' => 'Admin/BlogController@deleteCategory',

		// admin grades pages

	'admin/grades/all' => 'Admin/GradeController@index',

	'admin/grades/store' => 'Admin/GradeController@store',

	'admin/grades/get' => 'Admin/GradeController@grades',

	'admin/grades/update' => 'Admin/GradeController@update',

	'admin/grades/delete' => 'Admin/GradeController@delete',

		// admin section pages

	'admin/sections/all' => 'Admin/SectionController@index',

	'admin/sections/store' => 'Admin/SectionController@store',

	'admin/sections/get' => 'Admin/SectionController@sections',

	'admin/sections/update' => 'Admin/SectionController@update',

	'admin/sections/delete' => 'Admin/SectionController@delete',

		// admin subject pages

	'admin/subjects/all' => 'Admin/SubjectController@index',

	'admin/subjects/store' => 'Admin/SubjectController@store',

	'admin/subjects/get' => 'Admin/SubjectController@subjects',

	'admin/subjects/update' => 'Admin/SubjectController@update',

	'admin/subjects/delete' => 'Admin/SubjectController@delete',

		// admin classroom pages

	'admin/classrooms/all' => 'Admin/ClassroomController@index',

	'admin/classrooms/store' => 'Admin/ClassroomController@store',

	'admin/classrooms/get' => 'Admin/ClassroomController@classrooms',

	'admin/classrooms/update' => 'Admin/ClassroomController@update',

	'admin/classrooms/delete' => 'Admin/ClassroomController@delete',

		// admin attendances pages

	'admin/attendances/all' => 'Admin/AttendanceController@index',

	'admin/attendances/create' => 'Admin/AttendanceController@create',

	'admin/attendances/students' => 'Admin/AttendanceController@students',

	'admin/attendances/store' => 'Admin/AttendanceController@store',

	'admin/attendances/show' => 'Admin/AttendanceController@show',

	'admin/attendances/edit' => 'Admin/AttendanceController@edit',

	'admin/attendances/update' => 'Admin/AttendanceController@update',

	'admin/attendances/delete' => 'Admin/AttendanceController@delete',

		// admin exams pages

	'admin/exams/all' => 'Admin/ExamController@index',

	'admin/exams/create' => 'Admin/ExamController@create',

	'admin/exams/store' => 'Admin/ExamController@store',

	'admin/exams/show' => 'Admin/ExamController@show',

	'admin/exams/approve' => 'Admin/ExamController@approve',

	'admin/exams/edit' => 'Admin/ExamController@edit',

	'admin/exams/edit/marks' => 'Admin/ExamController@editMarks',

	'admin/exams/update' => 'Admin/ExamController@update',

	'admin/exams/update/marks' => 'Admin/ExamController@updateMarks',

	'admin/exams/delete' => 'Admin/ExamController@delete',

	'admin/exams/categories/all' => 'Admin/ExamController@allCategories',

	'admin/exams/categories/get' => 'Admin/ExamController@categories',

	'admin/exams/categories/store' => 'Admin/ExamController@storeCategory',

	'admin/exams/categories/update' => 'Admin/ExamController@updateCategory',

	'admin/exams/categories/delete' => 'Admin/ExamController@deleteCategory',

		// admin period pages

	'admin/periods/all' => 'Admin/PeriodController@index',

	'admin/periods/create' => 'Admin/PeriodController@create',

	'admin/periods/store' => 'Admin/PeriodController@store',

	'admin/periods/edit' => 'Admin/PeriodController@edit',

	'admin/periods/update' => 'Admin/PeriodController@update',

	'admin/periods/delete' => 'Admin/PeriodController@delete',

		// admin session pages

	'admin/sessions/all' => 'Admin/SessionController@index',

	'admin/sessions/create' => 'Admin/SessionController@create',

	'admin/sessions/store' => 'Admin/SessionController@store',

	'admin/sessions/edit' => 'Admin/SessionController@edit',

	'admin/sessions/update' => 'Admin/SessionController@update',

	'admin/sessions/delete' => 'Admin/SessionController@delete',

		// admin schedule pages

	'admin/schedules/all' => 'Admin/ScheduleController@index',

	'admin/schedules/create' => 'Admin/ScheduleController@create',

	'admin/schedules/store' => 'Admin/ScheduleController@store',

	'admin/schedules/show' => 'Admin/ScheduleController@show',

	'admin/schedules/edit' => 'Admin/ScheduleController@edit',

	'admin/schedules/update' => 'Admin/ScheduleController@update',

	'admin/schedules/change' => 'Admin/ScheduleController@change',

	'admin/schedules/update/teacher/classroom' => 'Admin/ScheduleController@updateTeacherClassroom',

	'admin/schedules/delete' => 'Admin/ScheduleController@delete',

		// admin user pages

	'admin/users/all' => 'Admin/UserController@index',

	'admin/users/create' => 'Admin/UserController@create',

	'admin/users/generate/username' => 'Admin/UserController@generateUsername',

	'admin/users/store' => 'Admin/UserController@store',

	'admin/users/show' => 'Admin/UserController@show',

	'admin/users/edit' => 'Admin/UserController@edit',

	'admin/users/edit/password' => 'Admin/UserController@editPassword',

	'admin/users/update' => 'Admin/UserController@update',

	'admin/users/update/avatar' => 'Admin/UserController@updateAvatar',

	'admin/users/update/password' => 'Admin/UserController@updatePassword',

	'admin/users/transactions/all' => 'Admin/UserController@transactions',

	'admin/users/transactions/accountings' => 'Admin/UserController@getAccountings',

	'admin/users/transactions/accountings/details' => 'Admin/UserController@getAccountingDetails',

	'admin/users/transactions/store' => 'Admin/UserController@storeTransaction',

	'admin/users/transactions/edit' => 'Admin/UserController@editTransaction',

	'admin/users/transactions/update' => 'Admin/UserController@updateTransaction',

	'admin/users/transactions/delete' => 'Admin/UserController@deleteTransaction',

	'admin/users/delete' => 'Admin/UserController@delete',

	'admin/users/search' => 'Admin/UserController@search',

	'admin/users/find' => 'Admin/UserController@find',

	'admin/users/restore' => 'Admin/UserController@restoreUser',

		// admin student pages

	'admin/students/all' => 'Admin/StudentController@index',

	'admin/students/create' => 'Admin/StudentController@create',

	'admin/students/store' => 'Admin/StudentController@store',

	'admin/students/show' => 'Admin/StudentController@show',

	'admin/students/edit' => 'Admin/StudentController@edit',

	'admin/students/update' => 'Admin/StudentController@update',

	'admin/students/delete' => 'Admin/StudentController@delete',

	'admin/students/education' => 'Admin/StudentController@education',

	'admin/students/education/roll' => 'Admin/StudentController@getNewRoll',

	'admin/students/education/store' => 'Admin/StudentController@storeEducation',

	'admin/students/education/delete' => 'Admin/StudentController@deleteEducation',

	'admin/students/files/all' => 'Admin/StudentController@allFiles',

	'admin/students/files/store' => 'Admin/StudentController@storeFile',

	'admin/students/files/get' => 'Admin/StudentController@files',

	'admin/students/files/update' => 'Admin/StudentController@updateFile',

	'admin/students/files/delete' => 'Admin/StudentController@deleteFile',

	'admin/students/search' => 'Admin/StudentController@search',

	'admin/students/find' => 'Admin/StudentController@find',

		// admin teacher pages

	'admin/teachers/all' => 'Admin/TeacherController@index',

	'admin/teachers/create' => 'Admin/TeacherController@create',

	'admin/teachers/store' => 'Admin/TeacherController@store',

	'admin/teachers/show' => 'Admin/TeacherController@show',

	'admin/teachers/edit' => 'Admin/TeacherController@edit',

	'admin/teachers/update' => 'Admin/TeacherController@update',

	'admin/teachers/delete' => 'Admin/TeacherController@delete',

	'admin/teachers/search' => 'Admin/TeacherController@search',

	'admin/teachers/find' => 'Admin/TeacherController@find',

		// admin accountant pages

	'admin/accountants/all' => 'Admin/AccountantController@index',

	'admin/accountants/create' => 'Admin/AccountantController@create',

	'admin/accountants/store' => 'Admin/AccountantController@store',

	'admin/accountants/show' => 'Admin/AccountantController@show',

	'admin/accountants/edit' => 'Admin/AccountantController@edit',

	'admin/accountants/update' => 'Admin/AccountantController@update',

	'admin/accountants/delete' => 'Admin/AccountantController@delete',

	'admin/accountants/search' => 'Admin/AccountantController@search',

	'admin/accountants/find' => 'Admin/AccountantController@find',

		// admin accountings pages

	'admin/accountings/all' => 'Admin/AccountingController@index',

	'admin/accountings/create' => 'Admin/AccountingController@create',

	'admin/accountings/store' => 'Admin/AccountingController@store',

	'admin/accountings/show' => 'Admin/AccountingController@show',

	'admin/accountings/update/users' => 'Admin/AccountingController@updateUsers',

	'admin/accountings/update/grades' => 'Admin/AccountingController@updateGrades',

	'admin/accountings/edit' => 'Admin/AccountingController@edit',

	'admin/accountings/update' => 'Admin/AccountingController@update',

	'admin/accountings/delete' => 'Admin/AccountingController@delete',

	'admin/accountings/categories/all' => 'Admin/AccountingController@allCategories',

	'admin/accountings/categories/get' => 'Admin/AccountingController@categories',

	'admin/accountings/categories/store' => 'Admin/AccountingController@storeCategory',

	'admin/accountings/categories/update' => 'Admin/AccountingController@updateCategory',

	'admin/accountings/categories/delete' => 'Admin/AccountingController@deleteCategory',

	'admin/accountings/transactions' => 'Admin/AccountingController@transactions',

		// admin notice pages

	'admin/notices/all' => 'Admin/NoticeController@index',

	'admin/notices/store' => 'Admin/NoticeController@store',

	'admin/notices/show' => 'Admin/NoticeController@show',

	'admin/notices/edit' => 'Admin/NoticeController@edit',

	'admin/notices/update' => 'Admin/NoticeController@update',

	'admin/notices/sms/send' => 'Admin/NoticeController@sendSMS',

	'admin/notices/delete' => 'Admin/NoticeController@delete',

		// admin files pages

	'admin/files/all' => 'Admin/AdvancedController@allFiles',

	'admin/files/store' => 'Admin/AdvancedController@storeFiles',

	'admin/files/get' => 'Admin/AdvancedController@files',

	'admin/files/update' => 'Admin/AdvancedController@updateFile',

	'admin/files/delete' => 'Admin/AdvancedController@deleteFile',

		// admin charts pages

	'admin/charts/all' => 'Admin/AdvancedController@allCharts',

	'admin/charts/year' => 'Admin/AdvancedController@getMonthlyStudents',

		// admin database pages

	'admin/database' => 'Admin/AdvancedController@database',

	'admin/database/users/import' => 'Admin/AdvancedController@importUsers',

	'admin/database/students' => 'Admin/AdvancedController@studentDatabase',

	'admin/database/education' => 'Admin/AdvancedController@educationDatabase',

	'admin/database/teachers' => 'Admin/AdvancedController@teacherDatabase',

	'admin/database/schedules' => 'Admin/AdvancedController@scheduleDatabase',

	'admin/database/accountants' => 'Admin/AdvancedController@accountantDatabase',

	'admin/database/students/clear' => 'Admin/AdvancedController@clearStudents',

	'admin/database/education/clear' => 'Admin/AdvancedController@clearEDucation',

	'admin/database/teachers/clear' => 'Admin/AdvancedController@clearTeachers',

	'admin/database/schedules/clear' => 'Admin/AdvancedController@clearSchedules',

	'admin/database/accountants/clear' => 'Admin/AdvancedController@clearAccountants',

];
