<?php

/**
 * This class is used to get posts
 */
class Post
{

	private $con;
	private $table = 'posts';

	// post properties
	public $id;
	public $title;
	public $body;
	public $created_at;

	public function __construct($db)
	{
		$this->con = $db;
	}

	// get all posts
	public function index()
	{
		$query = 'SELECT
			p.id,
			p.title,
			p.body,
			p.created_at
		FROM '.$this->table.' p
		ORDER BY p.created_at DESC';

		// preparing query statement
		$stmt = $this->con->prepare($query);

		// executing query statement
		$stmt->execute();

		return $stmt;
	}

	// get single post
	public function single()
	{
		$query = 'SELECT
			p.id,
			p.title,
			p.body,
			p.created_at
		FROM '.$this->table.' p
		WHERE
			p.id=?
		LIMIT 0,1';

		// preparing query statement
		$stmt = $this->con->prepare($query);

		// bind post ID
		$stmt->bindParam(1, $this->id);

		// executing query statement
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->title = $row['title'];
		$this->body = $row['body'];
	}

	// create new post
	public function create()
	{
		$query = 'INSERT INTO '
		.$this->table. ' 
		SET
			title = :title,
			body = :body';

		// preparing query statement
		$stmt = $this->con->prepare($query);

		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->body = htmlspecialchars(strip_tags($this->body));

		// bind post data
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':body', $this->body);

		if ($stmt->execute()) {
			return true;
		}

		printf("Error: %s.\n", $stmt->error);

		return false;
	}
}