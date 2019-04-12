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

/* query posts by using index
	method defined in Post model
*/
$result = $post->index();

$num = $result->rowCount();

if ($num > 0) {
	// get all posts in a json array
	$posts_arr = array();

	// loop through all posts
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$post_item = array(
			'id'	=> $id,
			'title'	=> $title,
			'body'	=> html_entity_decode($body)
		);

		// add each post item to posts data array
		array_push($posts_arr, $post_item);

		// convert posts array to json
		echo json_encode($posts_arr);
	}
} else {
	// no posts found
	echo json_encode(array(
		'msg' => 'No posts found'
	));
}