<?php
namespace App\Models;

use mysqli;

class TaskModel{
    private $name;
    private $description;
    private $status;
    private $duedate;

    private $conn;

    public function __construct()
    {
        $this->conn = new \mysqli("localhost", "doe", "doe123", "task_db");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function addNewTask(){
        $sql = "INSERT INTO task_db(name,description,status,duedate)VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: ".$this->conn->error);
        }
        $stmt->bind_param("ssss", $this->name,$this->description,$this->status,$this->duedate);
        if ($stmt->execute()){
            echo "New task was added.";
        }else{
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    public function deleteTask(int $id){
        $sql = "DELETE FROM task_db WHERE id = ?";
        $statement = $this->conn->prepare($sql);
        if ($statement === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $statement->bind_param("i", $id);
        if ($statement->execute()){
            echo "Task was deleted.";
        }else{
            echo "Error: " . $statement->error;
        }

        $statement->close();
    }

    public function getAllTaskByUserId(int $id): array{
        $sql = "SELECT id,name, description, status,user_id duedate FROM task_db WHERE user_id = ?";
        $statement = $this->conn->prepare($sql);
        if ($statement === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $statement->bind_param("i",$id);
        if (!$statement->execute()){
            echo "Error: " . $statement->error;
        }
        $result = $statement->get_result()->fetch_assoc();
        $statement->close();
        return $result;
    }

    public function updateTaskById(int $id){
        $sql = "UPDATE task_db SET name=?,description=?,status=?,duedate=? WHERE id=?";
        $statement = $this->conn->prepare($sql);
        if ($statement === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $statement->bind_param("ssssi",$this->name,$this->description,$this->status,$this->status,$this->duedate,$id);
        if ($statement->execute()){
            echo "Task was successfully updated.";
        }else{
            echo "Error: " . $statement->error;
        }
        $statement->close();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}