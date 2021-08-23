<?php
class User
{
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $type;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read(){
        $query='SELECT u.id AS UserId, u.username AS Username, u.password AS Password, t.name AS Type FROM users u,usertype t WHERE t.id=u.type ORDER BY t.id ASC';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function login(){
        $query='SELECT u.id AS UserId, u.username AS Username, u.password AS Password, t.name AS Type FROM users u,usertype t WHERE t.id=u.type AND u.username="'.$this->username.'" AND u.password="'.$this->password.'"';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}