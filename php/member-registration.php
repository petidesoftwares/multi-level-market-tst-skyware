<?php
    require('connection.php');
    $conn = Connect_DB::createConnection();
    if($conn){
        $db_select = Connect_DB::selectDB($conn);
        if($db_select){
            if(isset($_POST['submit']) && $_POST['submit']=="Submit"){
                $title = $_POST['title'];
                $surname = $_POST['surname'];
                $firstname = $_POST['firstname'];
                $othername = $_POST['othername'];
                $gender = $_POST['sex'];
                $phone_number = $_POST['phone_number'];
                $email = $_POST['email'];
                $ref = $_POST['referrer'];

                /***********upload user data to data base */

                $insertMember = mysqli_query($conn,"INSERT INTO member(
                    title,
                    surname,
                    firstname,
                    othername,
                    gender,
                    phone_number,
                    email
                ) VALUES(
                    '".mysqli_real_escape_string($conn, $title)."',
                    '".mysqli_real_escape_string($conn, $surname)."',
                    '".mysqli_real_escape_string($conn, $firstname)."',
                    '".mysqli_real_escape_string($conn, $othername)."',
                    '".mysqli_real_escape_string($conn, $gender)."',
                    '".mysqli_real_escape_string($conn, $phone_number)."',
                    '".mysqli_real_escape_string($conn, $email)."'
                )") or die(mysqli_error($conn));

                if($insertMember){
                    $queryMemberId = mysqli_query($conn, 'SELECT id FROM member ORDER BY id DESC LIMIT 1');
                    if(mysqli_num_rows($queryMemberId)>0){
                        $id = mysqli_fetch_assoc($queryMemberId);
                        $assignReferrer = mysqli_query($conn, "INSERT INTO member_reference(
                            referrer_id,
                            referred_id
                        ) VALUES(
                            '".mysqli_real_escape_string($conn, $ref)."',
                            '".mysqli_real_escape_string($conn, $id['id'])."'
                        )") or die(mysqli_error($conn));
                        if($assignReferrer){
                            Connect_DB::closeConnection($conn);
                            header('Location:../html/home.html');
                        }
                    }
                }else {
                    echo "registration failed due to network failure. Try again later";
                }
            }
            else{
                echo "Network Error!";
            }
        }else{
            echo "Database not found";
        }
    }else{
        echo "connection failed";
    }

?>