<?php

    include 'config/config.php';

    class Database{
        public $host = HOST;
        public $user = USER;
        public $password = PASSWORD;
        public $database = DATABASE;

        public $link;
        public $error;

        public function __construct()
        {
            $this->dbConnect();
        }

        public function dbConnect(){
            $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            if (!$this->link) {
                $this->error ="Database connection failed";
                return false;
            }
        }

        //insert method eta holo normal 

            //public function insert($query){
                //$result = mysqli_query($this->link, $query) or die ($this->link->error .__LINE__);
                //if ($result){
                    //return $result;
               // }return false;
            //}


//insert method eta holo chatgpt 
        public function insert($query){
            $result = mysqli_query($this->link, $query);
            if (!$result) {
                throw new Exception("Error executing query: " . mysqli_error($this->link));
            }
            return $result;
        }

           // select method 
            public function select($query){
               $result = mysqli_query($this->link, $query) or die ($this->link->error .__LINE__);
               if (mysqli_num_rows($result) > 0) {
                   return $result;
              }
              return false;
           }

          //public function select($query, $params = []) {
           // $stmt = mysqli_prepare($this->link, $query);
          //  if ($params) {
           //     mysqli_stmt_bind_param($stmt, str_repeat("s", count($params)), ...$params);
           // }
           // mysqli_stmt_execute($stmt);
          //  $result = mysqli_stmt_get_result($stmt);
            //if (!$result) {
           //     throw new Exception("Error executing query: " . mysqli_error($this->link));
           // }
           // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
           // mysqli_stmt_close($stmt);
           // return $rows;
       // }
        
       //update method eta holo chatgpt 
       public function update($query){
        $result = mysqli_query($this->link, $query);
        if (!$result) {
            throw new Exception("Error executing query: " . mysqli_error($this->link));
        }
        return $result;
       }

       //delete method eta holo chatgpt 
       public function delete($query){
        $result = mysqli_query($this->link, $query);
        if (!$result) {
            throw new Exception("Error executing query: " . mysqli_error($this->link));
        }
        return $result;
       }
            

    }

?>