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
                echo "Insertion failled...";
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