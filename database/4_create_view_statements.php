<?php

return [

		// Create items view

	'create_items_view' => 	"CREATE VIEW `items_view` AS SELECT i.id AS id, i.name as name, i.price as price, i.user_id as user_id, u.username AS username, i.created_at AS created_at, i.updated_at AS updated_at, i.deleted_at AS deleted_at FROM items i, users u WHERE i.user_id = u.id",

		// Create reset password link view

	'create_reset_password_links_view' => 	"CREATE VIEW `reset_password_links_view` AS SELECT r.id AS id, r.user_id AS user_id, u.name AS name, r.token AS token, r.validity AS validity, r.created_at AS created_at, u.updated_at AS updated_at, u.deleted_at AS deleted_at FROM users u, reset_password_links r WHERE r.user_id = u.id",

];