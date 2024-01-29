<?php

    //DB Helper
    class Config {

        //Attributes
        private $HOST = "127.0.0.1";
        private $USERNAME = "root";
        private $PSW = "";
        private $DB_NAME = "php-3";
        private $table_name = "student";
        public $conn;

        public function __construct() {
            $this->conn = mysqli_connect($this->HOST,$this->USERNAME,$this->PSW,$this->DB_NAME);

            if($this->conn) {
            }
            else {
                echo "Failled to connect...";
            }
        }

        //insert
        public function insert($name,$age,$course) {

            $query = "INSERT INTO $this->table_name(name,age,course) VALUES('$name',$age,'$course')";

            $res = mysqli_query($this->conn,$query); //(object of mysqli_connect, query)   =>  1/0

            if($res) {
                // echo "$res: Inserted successfully...";
            }
            else {
                // echo "Insertion failled...";
            }

            return $res;

        }

        //display
        public function getAllData() {

            $query = "SELECT * FROM $this->table_name";

            $res = mysqli_query($this->conn,$query);   //mysqli_result

            // print_r($res);
            // var_dump($res);

            // while($data = mysqli_fetch_array($res)) {
            //     $data = mysqli_fetch_array($res);   //  mysqli_result   =>  array
            //     print_r($data);
            //     echo "<br>";
            // }

            return $res;

        }

        public function getSingleRecord($id) {
            $query = "SELECT * FROM $this->table_name WHERE id=$id";
            return mysqli_query($this->conn,$query);    //mysqli_result
        }

        //Delete
        public function delete($id) {
            $query = "DELETE FROM $this->table_name WHERE id=$id";
            return mysqli_query($this->conn,$query);    //count of deleted records
        }

        //Update
        public function update($id,$name,$age,$course) {
            $query = "UPDATE $this->table_name SET name='$name',age=$age,course='$course' WHERE id=$id";
            $res = mysqli_query($this->conn,$query);
            return $res ? "$id updated..." : "$id failed to update...";
        }

        //Register user
        public function register_user($user_name,$password) {
            $query = "INSERT INTO users(user_name,password) VALUES('$user_name','$password')";

            $res = mysqli_query($this->conn,$query); //(object of mysqli_connect, query)   =>  1/0

            http_response_code($res ? 201 : 403);

            return $res ? "User created..." : "User failed to create...";
        }

        private function getUserByName($user_name) {
            $query = "SELECT * FROM users WHERE user_name='$user_name'";

            return mysqli_query($this->conn,$query);
        }

        public function login($user_name,$password) {

            $res = $this->getUserByName($user_name);
            
            if(mysqli_num_rows($res) == 1) {
                $record = mysqli_fetch_array($res); // mysqli_result    =>  Array

                if(password_verify($password,$record['password'])) {
                    return "Login successfully...";
                }
                else {
                    return "Invalid password...";
                }

            }
            else {
                return "User does not exist !!";
            }

        }

        public function insertMedia($name,$path) {
            $query = "INSERT INTO media(name,path) VALUES('$name','$path')";

            return mysqli_query($this->conn,$query);
        }

        private function getMedia($id) {
            $query = "SELECT * FROM media";
            return mysqli_query($this->conn,$query);
        }

        public function deleteMedia($id) {
            $result = $this->getMedia($id);
            
            if(mysqli_num_rows($result)) {
                $record = mysqli_fetch_array($result);

                echo $record['name'];

                $query = "DELETE FROM media WHERE id=$id";

                $ans = mysqli_query($this->conn,$query);

                return ($ans == 1 && unlink("../uploads/" . $record['name'])) 
                    ? "Deleted successfully" 
                    : "Deletion failled...";

            }
            else {
                return "Media doesn't exists...";
            }
        }

    }

    class Demo {
        //Attributes    => Data members
        private $a;
        private $b;

        //Methods       => Data member functions
        public function setData($a,$b) {
            //  $this-> (Points to)
            $this->a = $a;  
            $this->b = $b;
        }

        public function getData() {
            echo "a: " . $this->a . "<br>";
            echo "b: " . $this->b . "<br>";
        }

        //Constructor
        public function __construct() {
            echo "Demo initialized... <br><hr>";
        }

    }

?>