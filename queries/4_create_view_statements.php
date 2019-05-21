<?php

return [

		// Create students view

	'create_students_view' => 	"CREATE VIEW `students_view` AS SELECT s.id AS id, u.name AS name, u.username AS username, s.father_name AS father_name, s.mother_name AS mother_name, u.email AS email, u.contact AS personal_contact, s.guardian_contact AS guardian_contact, u.dob AS dob, u.gender AS gender, u.role AS role, u.designation AS designation, u.address AS present_address, s.permanent_address AS permanent_address, u.avatar AS avatar, se.roll AS roll, g.name AS grade, ss.name AS session, ss.start_date AS session_start_date, ss.end_date AS session_end_date, sc.name AS section, s.created_at AS created_at, s.updated_at AS updated_at, s.deleted_at AS deleted_at FROM students s LEFT JOIN (SELECT e.roll AS roll, e.student_id AS student_id, e.session_id AS session_id, e.grade_id AS grade_id, e.section_id AS section_id FROM education_archive e, (SELECT MAX(id) AS id FROM education_archive WHERE deleted_at IS NULL GROUP BY student_id) AS ea WHERE e.id = ea.id) se ON se.student_id = s.id LEFT JOIN sessions ss ON se.session_id = ss.id LEFT JOIN sections sc ON se.section_id = sc.id LEFT JOIN grades g ON se.grade_id = g.id, users u WHERE u.id = s.user_id",

		// Create student files view

	'create_student files_view' => 	"CREATE VIEW `student_files_view` AS SELECT sf.id AS id, u.name AS name, u.username AS username, sf.name as file_name, sf.path as file_path, sf.created_at AS created_at, sf.updated_at AS updated_at, sf.deleted_at AS deleted_at FROM students s, student_files sf, users u WHERE u.id = s.user_id AND s.id = sf.student_id",

		// Create teachers view

	'create_teachers_view' => 	"CREATE VIEW `teachers_view` AS SELECT t.id AS id, u.username AS username, u.name AS name, u.email AS email, u.contact AS contact, u.dob AS dob, u.gender AS gender, u.role AS role, u.designation AS designation, t.teacher_type AS teacher_type, u.address AS address, t.created_at AS created_at, t.updated_at AS updated_at, t.deleted_at AS deleted_at FROM users u, teachers t WHERE t.user_id = u.id",

		// Create teachers view

	'create_accountants_view' => "CREATE VIEW `accountants_view` AS SELECT a.id AS id, u.username AS username, u.name AS name, u.email AS email, u.contact AS contact, u.dob AS dob, u.gender AS gender, u.role AS role, u.designation AS designation, a.accountant_type AS accountant_type, u.address AS address, a.created_at AS created_at, a.updated_at AS updated_at, a.deleted_at AS deleted_at FROM users u, accountants a WHERE a.user_id = u.id",

		// Create attendances view

	'create_attendances_view' => "CREATE VIEW `attendances_view` AS SELECT a.id AS id, a.attendance_date AS attendance_date, a.students AS students, a.grade_id AS grade_id, g.name AS grade_name, a.section_id AS section_id, sc.name AS section_name, a.session_id AS session_id, se.name AS session_name, se.start_date AS session_start_date, se.end_date AS session_end_date, a.user_id AS user_id, u.username AS username, u.name AS name, a.created_at AS created_at, a.updated_at AS updated_at, a.deleted_at AS deleted_at FROM attendances a, grades g, sections sc, sessions se, users u WHERE a.grade_id = g.id AND a.section_id = sc.id AND a.session_id = se.id AND a.user_id = u.id",

		// Create schedules view

	'create_schedules_view' => 	"CREATE VIEW `schedules_view` AS SELECT s.id AS id, s.grade_id AS grade_id, g.name AS grade_name, s.section_id AS section_id, sc.name AS section_name, s.session_id AS session_id, se.name AS session_name, se.start_date AS session_start_date, se.end_date AS session_end_date, s.subject_id AS subject_id, su.name AS subject_name, s.scheduled_days AS scheduled_days, s.period_id AS period_id, p.name AS period_name, s.start_time AS start_time, s.end_time AS end_time, s.teacher_id AS teacher_id, u.username AS teacher_username, u.name AS teacher_name, s.classroom_id AS classroom_id, c.name AS classroom_name, s.created_at AS created_at, s.updated_at AS updated_at, s.deleted_at AS deleted_at FROM schedules s JOIN grades g ON s.grade_id = g.id JOIN sections sc ON s.section_id = sc.id JOIN sessions se ON s.session_id = se.id JOIN subjects su ON s.subject_id = su.id JOIN periods p ON s.period_id = p.id LEFT JOIN teachers t ON s.teacher_id = t.id LEFT JOIN users u ON t.user_id = u.id LEFT JOIN classrooms c ON s.classroom_id = c.id",

		// Create education archive view

	'create_education_archive_view' => "CREATE VIEW `education_archive_view` AS SELECT ed.id AS id, ed.student_id AS student_id, u.username AS username, u.name AS name, ed.roll AS student_roll, ed.grade_id AS grade_id, g.name AS grade_name, ed.section_id AS section_id, sc.name AS section_name, ed.session_id AS session_id, se.name AS session_name, se.start_date AS session_start_date, se.end_date AS session_end_date, ed.created_at AS created_at, ed.updated_at AS updated_at, ed.deleted_at AS deleted_at FROM education_archive ed, users u, students st, sessions se, grades g, sections sc WHERE ed.student_id = st.id AND st.user_id = u.id AND ed.session_id = se.id AND ed.grade_id = g.id AND ed.section_id = sc.id",

		// Create message subject view

	'create_message_subjects_view' => "CREATE VIEW `message_subjects_view` AS SELECT m.id AS id, m.subject_text AS subject_text, ms.id AS latest_message_id, ms.message_text AS latest_message_text, mp.user_id AS user_id, ump.username AS username, u.username AS latest_message_username, u.name AS latest_message_name, u.avatar AS latest_message_avatar, ms.created_at AS latest_message_date, m.created_at AS created_at, m.updated_at AS updated_at, mp.deleted_at AS deleted_at FROM message_subjects m LEFT JOIN (SELECT ms.id AS id, ms.message_subject_id AS message_subject_id, m.message_text AS message_text, m.user_id AS user_id, m.created_at AS created_at FROM messages m, (SELECT MAX(id) AS id, message_subject_id FROM messages WHERE deleted_at IS NULL GROUP BY message_subject_id) AS ms WHERE m.id = ms.id) ms ON m.id = ms.message_subject_id LEFT JOIN users u ON ms.user_id = u.id, message_participants mp, users ump WHERE mp.message_subject_id = m.id AND mp.user_id = ump.id ORDER BY ms.created_at DESC, m.created_at DESC",

		// Create messages view

	'create_messages_view' => "CREATE VIEW `messages_view` AS SELECT m.id AS id, m.message_text AS message_text, m.user_id AS user_id, u.username AS username, u.name AS name, u.avatar AS avatar, m.message_subject_id AS message_subject_id, m.created_at AS created_at, m.updated_at AS updated_at, m.deleted_at AS deleted_at FROM messages m, users u WHERE m.user_id = u.id ORDER BY m.created_at DESC;",

		// Create message participants view

	'create_message_participants_view' => "CREATE VIEW `message_participants_view` AS SELECT m.id AS id, m.user_id AS user_id, u.username AS username, u.name AS name, u.avatar AS avatar, m.message_subject_id AS message_subject_id, m.created_at AS created_at, m.updated_at AS updated_at, m.deleted_at AS deleted_at FROM message_participants m, users u WHERE m.user_id = u.id",

		// Create message viewers view

	'create_message_viewers_view' => "CREATE VIEW `message_viewers_view` AS SELECT m.id AS id, m.user_id AS user_id, u.username AS username, u.name AS name, u.avatar AS avatar, m.message_id AS message_id, m.created_at AS created_at, m.updated_at AS updated_at, m.deleted_at AS deleted_at FROM message_viewers m, users u WHERE m.user_id = u.id",

		// Create exams view

	'create_exams_view' => "CREATE VIEW `exams_view` AS SELECT e.id AS id, e.user_id AS user_id, u.username AS username, u.name AS name, e.session_id AS session_id, se.name AS session_name, e.grade_id AS grade_id, g.name AS grade_name, e.section_id AS section_id, sc.name AS section_name, e.category_id AS category_id, ec.name AS category_name, e.subject_id AS subject_id, s.name AS subject_name, e.title AS title, e.exam_date AS exam_date, e.exam_time AS exam_time, e.total_marks AS total_marks, e.duration AS duration, e.details AS details, e.approval AS approval, e.student_marks AS student_marks, e.created_at AS created_at, e.updated_at AS updated_at, e.deleted_at AS deleted_at FROM exams e, users u, sessions se, grades g, sections sc, exam_categories ec, subjects s WHERE e.user_id = u.id AND e.session_id = se.id AND e.grade_id = g.id AND e.section_id = sc.id AND e.category_id = ec.id AND e.subject_id = s.id",

		// Create blogs view

	'create_blogs_view' => "CREATE VIEW `blogs_view` AS SELECT b.id AS id, b.category_id AS category_id, bc.name AS category_name, b.user_id AS user_id, u.username AS author_username, u.name AS author_name, b.title AS title, b.tags AS tags, b.image_path AS image_path, b.details AS details, b.approval AS approval, b.views AS views, b.created_at AS created_at, b.updated_at AS updated_at, b.deleted_at AS deleted_at FROM blogs b, blog_categories bc, users u WHERE b.category_id = bc.id AND b.user_id = u.id",

		// Create notices view

	'create_notices_view' => "CREATE VIEW `notices_view` AS SELECT n.id, n.notice AS notice, n.broadcast AS broadcast, n.expiration AS expiration, IFNULL(nr.total,0) AS total_receivers, n.created_at AS created_at, n.updated_at AS updated_at, n.deleted_at AS deleted_at FROM notices n LEFT JOIN (SELECT notice_id, COUNT(notice_id) AS total FROM notice_receivers WHERE deleted_at IS NULL GROUP BY notice_id) nr ON n.id = nr.notice_id",

		// Create notice receivers view

	'create_notice_receivers_view' => "CREATE VIEW `notice_receivers_view` AS SELECT nr.id AS id, nr.notice_id AS notice_id, n.notice AS notice, nr.user_id AS user_id, u.username AS receiver_username, u.name AS receiver_name, nr.total_sent AS total_sent, nr.created_at AS created_at, nr.updated_at AS updated_at, nr.deleted_at AS deleted_at FROM notice_receivers nr, notices n, users u WHERE n.id = nr.notice_id AND u.id = nr.user_id",

		// Create accountings view

	'create_accountings_view' => "CREATE VIEW `accountings_view` AS SELECT a.id AS id, a.category_id AS category_id, ac.name AS category_name, a.description AS description, a.target AS target, a.amount AS amount, a.due_date AS due_date, a.yearly AS yearly, a.created_at AS created_at, a.updated_at AS updated_at, a.deleted_at AS deleted_at FROM accountings a, accounting_categories ac WHERE a.category_id = ac.id",

		// Create grade accountings view

	'create_grade_accountings_view' => "CREATE VIEW `grade_accountings_view` AS SELECT ga.id AS id, ga.accounting_id AS accounting_id, a.description AS description, a.target AS target, a.amount AS amount, a.due_date AS due_date, a.yearly AS yearly, a.category_id AS category_id, ac.name AS category_name, ga.grade_id AS grade_id, g.name AS grade_name, ga.created_at AS created_at, ga.updated_at AS updated_at, ga.deleted_at AS deleted_at FROM grade_accountings ga, accountings a, accounting_categories ac, grades g WHERE ga.accounting_id = a.id AND a.category_id = ac.id AND ga.grade_id = g.id",

		// Create user accountings view

	'create_user_accountings_view' => "CREATE VIEW `user_accountings_view` AS SELECT ua.id AS id, ua.accounting_id AS accounting_id, a.description AS description, a.target AS target, a.amount AS amount, a.due_date AS due_date, a.yearly AS yearly, a.category_id AS category_id, ac.name AS category_name, ua.user_id AS user_id, u.username AS username, u.name AS name, ua.created_at AS created_at, ua.updated_at AS updated_at, ua.deleted_at AS deleted_at FROM user_accountings ua, accountings a, accounting_categories ac, users u WHERE ua.accounting_id = a.id AND a.category_id = ac.id AND ua.user_id = u.id",

		// Create transactions view

	'create_transactions_view' => "CREATE VIEW `transactions_view` AS SELECT t.id AS id, t.accounting_id AS accounting_id, a.description AS description, a.target AS target, a.amount AS amount, a.due_date AS due_date, a.yearly AS yearly, a.category_id AS category_id, ac.name AS category_name, t.user_id AS user_id, u.username AS username, u.name AS name, t.accountant_id AS accountant_id, act.username AS accountant_username, act.name AS accountant_name, t.transaction_type AS transaction_type, t.transaction_amount AS transaction_amount, t.comment AS comment, t.created_at AS created_at, t.updated_at AS updated_at, t.deleted_at AS deleted_at FROM transactions t, accountings a, accounting_categories ac, users u, users act WHERE t.accounting_id = a.id AND a.category_id = ac.id AND t.user_id = u.id AND t.accountant_id = act.id",

		// Create reset password link view

	'create_reset_password_links_view' => 	"CREATE VIEW `reset_password_links_view` AS SELECT r.id AS id, u.username AS username, u.name AS name, u.email AS email, u.contact AS contact, u.dob AS dob, u.gender AS gender, u.role AS role, u.designation AS designation, r.token AS token, r.validity AS validity, u.address AS address, r.created_at AS created_at, u.updated_at AS updated_at, u.deleted_at AS deleted_at FROM users u, reset_password_links r WHERE r.user_id = u.id",

];