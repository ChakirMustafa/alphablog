# Mioblog

Mioblog is a small editorial blog built with PHP, PDO, and MySQL. It is designed as a clean, responsive place to discover, publish, and discuss short stories.

## Features

- Editorial home page with a featured story and responsive story cards
- Live search across published stories
- Estimated reading time and share-link action
- Account registration and login
- Publish, edit, and delete stories
- Public comments, with comment removal for the author or an admin
- Responsive navigation and writing forms with a live character counter
- Fictional demo account, stories, and a sample comment

## Local setup

Requirements: PHP with `pdo_mysql`, MySQL 8, Docker, and Symfony CLI.

Start MySQL:

```sh
docker run -d --name alphablog-mysql \
  -e MYSQL_ROOT_PASSWORD=19881206 \
  -e MYSQL_DATABASE=alphablog \
  -p 3306:3306 \
  mysql:8 --mysql-native-password=ON
```

Import the schema and demo content:

```sh
docker exec -i alphablog-mysql mysql -uroot -p19881206 < sql/mioblog.sql
docker exec -i alphablog-mysql mysql -uroot -p19881206 < sql/demo_seed.sql
```

Start the PHP app from the repository root:

```sh
symfony serve
```

Then open `http://127.0.0.1:8000`.

## test login user

- Email: `demo@alphablog.test`
- Password: `DemoBlog123!`

The demo account and content are fictional and for local development only. Do not use the bundled credentials or local database password in a public deployment.
