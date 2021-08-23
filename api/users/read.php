<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->read();
$num = $result->rowCount();
if($num>0){
    $userArr = array();
    $userArr['data']=array();
    while ($row=$result->fetch(PDO::FETCH_ASSOC)){
        $userItem= array(
            'UserId'=>$row['UserId'],
            'Username'=>$row['Username'],
            'Password'=>$row['Password'],
            'Type'=>$row['Type']
        );
        array_push($userArr['data'], $userItem);
    }
    echo json_encode($userArr);
}else{
    echo json_encode(array('message'=>'No users found'));
}