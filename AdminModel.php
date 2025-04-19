<?php

class AdminModel{
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->conn = new \mysqli("localhost", "doe", "doe123", "task_db");
        if ($this->conn->connect_error){
            die("Connecting failed: " . $this->conn->connect_error);
        }
    }

    public function __set($name, $value)
    {
        if (\property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    public function getUsersAndTasks(): array{
        $sql = "SELECT tasks.id, users.firstname, users.lastname, users.email, tasks.name,tasks.description, tasks.status, tasks.duedate 
                FROM users 
                INNER JOIN tasks ON users.id = tasks.user_id";
        $result = $this->conn->query($sql);
        if ($result === false){
            die("Error: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdminFirstname(int $id): string{
        $sql = "select firstname from users where id = ? and role='admin'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        return $result["firstname"];
    }

    public function registerAdmin(){
        $this->password = \password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(firstname,lastname,email,password,role)VALUES(?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }
        $role = "admin";
        $stmt->bind_param("sssss", $this->firstname,$this->lastname,$this->email,$this->password,$role);
        if ($stmt->execute()){
            echo "<script>alert('Admin was registered.')</script>";
            header("location: admin_login.php");
            exit();
        }else{
            echo "Error: " . $stmt->error;
        }
    }


    public function __destruct()
    {
        $this->conn->close();
    }
}