<?php
    require('connection.php');
    require('create-db.php');
    
    $conn = Connect_DB::createConnection();
    // Connect_DB::dropDB($conn,Consts::DB);
    
    createDB($conn,Consts::DB);
    Connect_DB::selectDB($conn);
    createTables($conn);
    Connect_DB::closeConnection($conn);

?>