<?php
    require('constants.php');

    class Connect_DB{

        public static function createConnection(){
            $conn = mysqli_connect(Consts::HOST,Consts::USER_NAME,Consts::PASSWORD) or die('No Connection Established');
            if($conn){
                return $conn;
            }
            return false;
        }

        public static function selectDB($db_conn){
            if(mysqli_select_db($db_conn, Consts::DB)==true){
                return true;
            }
            return false;
        }
        public static function closeConnection($db_conn){
            mysqli_close($db_conn);
        }

        public static function dropDB($db_conn,$db_name){
            mysqli_query($db_conn,"DROP DATABASE ".$db_name."");
        }

    }

?>