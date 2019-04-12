<?php

// set headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// including db and model files
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate new Database object
$database = new Database();

// connect to Database
$db = $database->connect();

// instantiate new Post object
$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

/* query posts by using single
	method defined in Post model
*/
$post->single();

$post = array(
	'id'	=> $post->id,
	'title'	=> $post->title,
	'body'	=> html_entity_decode($post->body)
);

echo json_encode($post);