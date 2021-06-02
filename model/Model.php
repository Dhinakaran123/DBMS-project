<?php

class Model{
    public function connect(){
        static $conn = null;
        $username = "dk_annanuniv";
        $pass = "dhinu2019";
        $connection_string = "dhinu-ora-instance.clhhbteyjrfi.ap-south-1.rds.amazonaws.com:1521/JOBSEEK";

        if(empty($conn)){
            $conn = oci_connect($username,$pass,$connection_string);
        }

        return $conn;
    }
}

?>