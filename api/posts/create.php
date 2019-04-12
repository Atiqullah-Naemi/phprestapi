<?php

// set headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization');

// including db and model files
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate new Database object
$database = new Database();

// connect to Database
$db = $database->connect();

// instantiate new Post object
$post = new Post($db);

$data = json_decode(file_get_contents('php://input'));

$post->title = $data->title;
$post->body = $data->body;

if ($post->create()) {
	echo json_encode(array(
		'msg' 	=> 'New post created successfully'
	));
} else {
	echo json_encode(array(
		'msg' 	=> 'There was a problem creating new post'
	));
}