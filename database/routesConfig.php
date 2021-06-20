<?php

	return [
		'routes' => [
			'GET' => [
				'/' 					=> 'App\Controllers\PostController@getPosts',
				'' 						=> 'App\Controllers\PostController@getPosts',
				'posts' 				=> 'App\Controllers\PostController@getPosts',
				'getPosts' 				=> 'App\Controllers\PostController@getPosts',
				'post/create' 			=> 'App\Controllers\PostController@create',
				'post/:id' 				=> 'App\Controllers\PostController@show',
				'post/:postId/edit' 	=> 'App\Controllers\PostController@edit',
				'auth/formsignup'		=> 'App\Controllers\AuthController@formsignup',
				'auth/showLogin'		=> 'App\Controllers\AuthController@showLogin',
			],
			'POST' => [
				'post/save' 				=> 'App\Controllers\PostController@save',
				'post/store' 				=> 'App\Controllers\PostController@store',
				'post/:postId/delete' 		=> 'App\Controllers\PostController@delete',
				'post/:postId/comment' 		=> 'App\Controllers\CommentController@save',
				'post/:postId/deleteCom'	=> 'App\Controllers\CommentController@deleteComment',
				'auth/signup'				=> 'App\Controllers\AuthController@signup',
				'auth/login'				=> 'App\Controllers\AuthController@login',
				'auth/logout'				=> 'App\Controllers\AuthController@logout',
			],
		],
	];