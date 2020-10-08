<?php
require('multilevel-market/connection.php');
$conn = Connect_DB::createConnection();
if($conn){
    $db_select = Connect_DB::selectDB($conn);
    if($db_select){
        $queryFGDownline = mysqli_query($conn,'SELECT referred_id FROM member_reference WHERE referrer_id=1');
        if(mysqli_num_rows($queryFGDownline)>0){
            while($rows =mysqli_fetch_assoc($queryFGDownline)){
                $getDownlineBioData = mysqli_query($conn, "SELECT title, surname, firstname, othername FROM member WHERE id =".$rows['referred_id']."");
                if(mysqli_num_rows($getDownlineBioData)>0){
                    $bios = mysqli_fetch_assoc($getDownlineBioData);
                    echo $bios['title']." ".$bios['surname'].", ".$bios['firstname']." ".$bios['surname']."<br>";
                }

            }
        }
    }
}

?>