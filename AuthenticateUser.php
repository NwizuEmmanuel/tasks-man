<?php
class AuthenticateUser{
    private $email;
    private $password;

    private $conn;

    public function __construct()
    {
        $this->conn = new \mysqli("localhost","doe","doe123","task_db");
    }

    public function __set($name, $value){
        if (\property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    public function verifyUser(){
        $sql = "SELECT * FROM users WHERE email=? and role='user'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $this->email);
        if (!$stmt->execute()){
            echo "Email not found.";
        }
        $result = $stmt->get_result()->fetch_assoc();
        $password = password_verify($this->password, $result['password']);
        if ($result['status'] === 'inactive'){
            die("Your account has been deactivated by our Administration control for violating some of our policies.\nContact the admin if this was mistake.");
        }
        if ($password){
            session_start();
            $_SESSION["userid"] = $result['id'];
            header("location: index.php");
            exit();
        }else{
            echo "Password is not correct.";
        }
    }

    public function verifyAdmin(){
        $sql = "SELECT * FROM users WHERE email=? and role='admin'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false){
            die("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $this->email);
        if (!$stmt->execute()){
            echo "Email not found.";
        }
        $result = $stmt->get_result()->fetch_assoc();
        $password = password_verify($this->password, $result['password']);
        if ($result['status'] === 'inactive'){
            die("Your account has been deactivated by our Administration control for violating some of our policies.\nContact the admin if this was mistake.");
        }
        if ($password){
            session_start();
            $_SESSION["userid"] = $result['id'];
            header("location: /admin/admin_page.php");
            exit();
        }else{
            echo "Password is not correct.";
        }
    }

}