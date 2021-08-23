<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Task.php';

$id = $_GET['id'];

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$task = new Task($db);

$task->id =$id;

if($task->completeTask()){
	echo json_encode(
		array('message' => 'Task Completed')
	);
}else{
	echo json_encode(
		array('message' => 'Task Not Completed')
	);
}
