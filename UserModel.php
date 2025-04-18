<?php
namespace App\Models;

use mysqli;

class UserModel{
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $status;
    private $conn;

    public function __construct()
    {
        $this->conn = new \mysqli("localhost", "doe", "doe123", "task_db");
        if ($this->conn->connect_error){
            die("Connecting failed: " . $this->conn->connect_error);
        }
    }

    public function __set($name, $value){
        if (\property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    public function addNewUser(){
        $this->password = \password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO task_db(firstname,lastname,email,password)VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $stmt->bind_param("ssss", $this->firstname,$this->lastname,$this->email,$this->password);
        if ($stmt->execute()){
            echo "New user was added.";
        }else{
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    public function makeUserActive(int $id){
        $sql = "UPDATE task_db SET status=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("si", $this->status, $id);
        if ($stmt->execute()){
            echo "User is active now.";
        }else{
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    public function makeUserInActive(int $id){
        $sql = "UPDATE task_db SET status=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("si", $this->status, $id);
        if ($stmt->execute()){
            echo "User is inactive now.";
        }else{
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}