USE `alphablog`;

INSERT INTO users (username, email, password, roletype)
SELECT 'Demo User', 'demo@alphablog.test',
	'$2y$12$ErV7kW8AUNelNln5rQeciOHXfjRD39d8y4il6lt3QE1ZhliUwBv9C', 'user'
WHERE NOT EXISTS (
	SELECT 1 FROM users WHERE email = 'demo@alphablog.test'
);

INSERT INTO posts (user_id, title, message, datecreated)
SELECT users.id, 'Demo: Morning Walk by the River',
	'A quiet morning walk is a good reminder to slow down, notice the details, and enjoy the light along the water.',
	'2026-11-16 09:30:00'
FROM users
WHERE users.email = 'demo@alphablog.test'
	AND NOT EXISTS (SELECT 1 FROM posts WHERE title = 'Demo: Morning Walk by the River');

INSERT INTO posts (user_id, title, message, datecreated)
SELECT users.id, 'Demo: Finding Light in the City',
	'Between the tall buildings, a small patch of afternoon sun changed the whole street. This sample post demonstrates how stories appear on the blog home page.',
	'2026-11-17 14:15:00'
FROM users
WHERE users.email = 'demo@alphablog.test'
	AND NOT EXISTS (SELECT 1 FROM posts WHERE title = 'Demo: Finding Light in the City');

INSERT INTO posts (user_id, title, message, datecreated)
SELECT users.id, 'Demo: Notes from a Weekend Hike',
	'We took an easy trail outside town and came back with fresh air, a few photos, and a reminder that a short trip can be enough to reset the week.',
	'2026-11-18 10:00:00'
FROM users
WHERE users.email = 'demo@alphablog.test'
	AND NOT EXISTS (SELECT 1 FROM posts WHERE title = 'Demo: Notes from a Weekend Hike');

INSERT INTO posts (user_id, title, message, datecreated)
SELECT users.id, 'Demo: A Note on Paying Attention, Revised',
	'Paying attention is a small practice with a surprisingly large return. A walk becomes a story when we slow down long enough to notice the details.',
	'2026-11-18 11:30:00'
FROM users
WHERE users.email = 'demo@alphablog.test'
	AND NOT EXISTS (SELECT 1 FROM posts WHERE title = 'Demo: A Note on Paying Attention, Revised');

INSERT INTO postscomments (post_id, comment, datecreated, email, user_id)
SELECT posts.id,
	'This is a lovely reminder to slow down and notice the small details along the way.',
	'2026-11-18 12:04:00',
	'reader@example.com',
	NULL
FROM posts
WHERE posts.title = 'Demo: Notes from a Weekend Hike'
	AND NOT EXISTS (
		SELECT 1 FROM postscomments
		WHERE postscomments.post_id = posts.id
			AND postscomments.email = 'reader@example.com'
	);
