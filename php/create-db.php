<?php
    function createDB($db_conn, $db_name){
        $createDb = mysqli_query($db_conn,"CREATE DATABASE IF NOT EXISTS ".$db_name."")or die(mysqli_error($db_conn));        
    }

    function createTables($db_conn){
        $table1 = mysqli_query($db_conn,"CREATE TABLE IF NOT EXISTS member(
            id INT NOT NULL AUTO_INCREMENT,
            title VARCHAR(10) NULL,
            surname VARCHAR(30) NOT NULL,
            firstname VARCHAR(30) NOT NULL,
            othername VARCHAR(50) NULL,
            gender enum('Male','Female') DEFAULT 'MALE',
            phone_number VARCHAR(14) NOT NULL,
            email VARCHAR(60) NULL,
            PRIMARY KEY(ID)
        )")or die(mysqli_error($db_conn));

        $table2 = mysqli_query($db_conn,"CREATE TABLE IF NOT EXISTS member_reference(
            referrer_id INT(11) NOT NULL,
            referred_id INT(11) NOT NULL,
            PRIMARY KEY(referrer_id, referred_id),
            FOREIGN KEY (referrer_id) REFERENCES member(id) ON DELETE CASCADE ON UPDATE CASCADE
        )")or die(mysqli_error($db_conn));
        if($table1 && $table2){
            return "DB completely set";
        }
    }

    function dropDB($db_conn,$db_name){
        mysqli_query($db_conn,"DROP DATABASE ".$db_name."");
    }
?>