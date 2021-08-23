<?php
    class Task{
        private $conn;
        private $table = 'tasks';

        public $id;
        public $name;
        public $text;
        public $time;
        public $userId;
        public $lng;
        public $lat;
        public $status;

        public function __construct($db)
        {
            $this->conn=$db;
        }

        public function read(){
            $query='SELECT t.name AS Name,t.id AS TaskId,t.text AS Description,t.time AS Time,u.username AS Worker,u.id AS WorkerId,s.name AS Status,t.lng AS Longitude,t.lat AS Latitude FROM tasks t,users u,statustype s WHERE u.id=t.userId AND t.status=s.id ORDER BY t.time ASC';
            $stmt=$this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readById(){
            $query='SELECT t.name AS Name,t.id AS TaskId,t.text AS Description,
t.time AS Time,u.username AS Worker,u.id AS WorkerId,s.name AS Status,
t.lng AS Longitude,t.lat AS Latitude FROM tasks t,users u,statustype s WHERE u.id=t.userId AND t.status=s.id AND t.id = ?';
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            return $stmt;
        }

        public function readByUser(){
            $query='SELECT t.name AS Name,t.id AS TaskId,t.text AS Description,
t.time AS Time,u.username AS Worker,u.id AS WorkerId,s.name AS Status,
t.lng AS Longitude,t.lat AS Latitude FROM tasks t,users u,statustype s WHERE u.id=t.userId AND t.status=s.id AND t.userId = ? ORDER BY t.time ASC';
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id=$row['TaskId'];
            $this->name=$row['Name'];
            $this->text=$row['Description'];
            $this->time=$row['Time'];
            $this->userId=$row['WorkerId'];
            $this->lng=$row['Longitude'];
            $this->lat=$row['Latitude'];
            $this->status=$row['Status'];
            return $stmt;
        }

        public function readByStatus(){
            $query='SELECT t.name AS Name,t.id AS TaskId,t.text AS Description,
t.time AS Time,u.username AS Worker,u.id AS WorkerId,s.name AS Status,
t.lng AS Longitude,t.lat AS Latitude FROM tasks t,users u,statustype s WHERE u.id=t.userId AND t.status=s.id AND t.status = ? ORDER BY t.time ASC';
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id=$row['TaskId'];
            $this->name=$row['Name'];
            $this->text=$row['Description'];
            $this->time=$row['Time'];
            $this->userId=$row['WorkerId'];
            $this->lng=$row['Longitude'];
            $this->lat=$row['Latitude'];
            $this->status=$row['Status'];
            return $stmt;
        }

        public function create() {
            $query = 'INSERT INTO ' . $this->table .
                ' SET name = :name,
                 text = :text,
                  time = :time,
                   userId = :userId,
                   lng = :lng,
                   lat = :lat,
                   status = :status';
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->text = htmlspecialchars(strip_tags($this->text));
            $this->time = htmlspecialchars(strip_tags($this->time));
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->lng = htmlspecialchars(strip_tags($this->lng));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->status = htmlspecialchars(strip_tags($this->status));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':text', $this->text);
            $stmt->bindParam(':time', $this->time);
            $stmt->bindParam(':userId', $this->userId);
            $stmt->bindParam(':lng', $this->lng);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':status', $this->status);

            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function update() {
            $query = 'UPDATE ' . $this->table .
                ' SET name = :name,
                 text = :text,
                  time = :time,
                   userId = :userId,
                   lng = :lng,
                   lat = :lat,
                   status = :status WHERE id = :id';
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->text = htmlspecialchars(strip_tags($this->text));
            $this->time = htmlspecialchars(strip_tags($this->time));
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->lng = htmlspecialchars(strip_tags($this->lng));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':text', $this->text);
            $stmt->bindParam(':time', $this->time);
            $stmt->bindParam(':userId', $this->userId);
            $stmt->bindParam(':lng', $this->lng);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':id', $this->id);


            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }