<?php
	session_start();
	require_once('../app/models/Post.php');
	require_once('../app/models/Comment.php');
	require_once('../helpers/functions.php');
	require_once('../DB/DBPDO.php');
	$options = require_once('../database/config.php');
	$ruotes = require_once('../database/routesConfig.php');
	require_once('../core/route.php');
	require_once('../app/controllers/BaseController.php');
	require_once('../app/controllers/PostController.php');
	require_once('../app/controllers/CommentController.php');
	require_once('../app/controllers/AuthController.php');
	require_once('../app/models/Session.php');

