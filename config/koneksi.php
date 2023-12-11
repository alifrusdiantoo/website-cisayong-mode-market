<?php
    class database{
        public $host = "localhost";
        public $user = "root";
        public $password = "";
        public $database = "db_cisayong_mm";
        public $koneksi;

        public function __construct()
        {
            $this->koneksi = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            if(!$this->koneksi){
                die("Tidak Terhubung ke Database" . mysqli_connect_error());
            }
        }
    }
?>