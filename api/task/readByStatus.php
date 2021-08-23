<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Task.php';

$database = new Database();
$db = $database->connect();

$task = new Task($db);
$task->id=isset($_GET['id']) ? $_GET['id'] : die();
$result = $task->readByStatus();
$num = $result->rowCount();
if($num>0){
    $task_arr=array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $taskItem= array(
            'Name'=>$row['Name'],
            'TaskId'=>$row['TaskId'],
            'Description'=>$row['Description'],
            'Time'=>$row['Time'],
            'Worker'=>$row['Worker'],
            'WorkerId'=>$row['WorkerId'],
            'Status'=>$row['Status'],
            'Longitude'=>$row['Longitude'],
            'Latitude '=>$row['Latitude']
        );
        array_push($task_arr, $taskItem);
    }
    http_response_code(200);
    echo json_encode($task_arr);
}else{
    http_response_code(404);
    echo json_encode(array('message'=>'No tasks found'));
}