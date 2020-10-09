<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Downline</title>
</head>
<body>
    
</body>
</html>

<?php
    require('connection.php');
    $conn = Connect_DB::createConnection();
    if($conn){
        $db_select = Connect_DB::selectDB($conn);
        if($db_select){
            $downlineTable = "<table>";
            $queryFGDownline = mysqli_query($conn,'SELECT referred_id FROM member_reference WHERE referrer_id=1');
            if(mysqli_num_rows($queryFGDownline)>0){
                while($rows =mysqli_fetch_assoc($queryFGDownline)){
                    $getFistDownlineBioData = mysqli_query($conn, "SELECT title, surname, firstname, othername FROM member WHERE id =".$rows['referred_id']."");
                    if(mysqli_num_rows($getFistDownlineBioData)>0){
                        $bios = mysqli_fetch_assoc($getFistDownlineBioData);
                        $downlineTable.= '<tr><td rowspan="3"><b>'. $bios['title']." ".$bios['surname'].", ".$bios['firstname']." ".$bios['othername']."</b></td>";
                    }
                    $querySecondDL = mysqli_query($conn,'SELECT referred_id FROM member_reference WHERE referrer_id='.$rows['referred_id'].'');
                    if(mysqli_num_rows($querySecondDL)>0){
                        while($s_level_id = mysqli_fetch_assoc($querySecondDL)){                   
                            $getDownlineBioData = mysqli_query($conn, "SELECT title, surname, firstname, othername FROM member WHERE id =".$s_level_id['referred_id']."");
                            if(mysqli_num_rows($getDownlineBioData)>0){
                                $bios = mysqli_fetch_assoc($getDownlineBioData);
                                $downlineTable.= '<td>'.$bios['title']." ".$bios['surname'].", ".$bios['firstname']." ".$bios['othername']."</td></tr>";
                            }
                        }
                        if(mysqli_num_rows($querySecondDL)>1 && mysqli_num_rows($querySecondDL)<3){
                            $downlineTable.= '<td></td></tr>';
                            
                        }
                        if(mysqli_num_rows($querySecondDL)>0 && mysqli_num_rows($querySecondDL)<2){
                            $downlineTable.= '<td></td></tr><tr><td></td></tr>';
                        }
                    }else{
                        $downlineTable.= '<td></td></tr><tr><td></td></tr><tr><td></td></tr>';
                    }
                } 
                $downlineTable.= "</table>";               
            }
            echo $downlineTable;
        }
    }
?>