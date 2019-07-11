<?php

return [

		// Create reset password link view

	'create_reset_password_links_view' => 	"CREATE VIEW `reset_password_links_view` AS SELECT r.id AS id, u.username AS username, u.name AS name, r.token AS token, r.validity AS validity, r.created_at AS created_at, u.updated_at AS updated_at, u.deleted_at AS deleted_at FROM users u, reset_password_links r WHERE r.user_id = u.id",

];