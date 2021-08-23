<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Task.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$task = new Task($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
// ID
$task->id = $data->id;

$task->name = $data->name;
$task->text = $data->text;
$task->time = $data->time;
$task->userId = $data->userId;
$task->lng = $data->lng;
$task->lat = $data->lat;
$task->status = $data->status;

// Create post
if($task->update()) {
    echo json_encode(
        array('message' => 'Post updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not updated')
    );
}
