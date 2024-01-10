<?php

    class Config {

        //Attributes
        private $HOST = "127.0.0.1";
        private $USERNAME = "root";
        private $PSW = "";
        private $DB_NAME = "php-3";
        public $conn;

        public function __construct() {
            $this->conn = mysqli_connect($this->HOST,$this->USERNAME,$this->PSW,$this->DB_NAME);

            if($this->conn) {
                echo "Connected...";
            }
            else {
                echo "Failled to connect...";
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