<?php

    echo "
        <form action='' method='POST'>
            <br>
            <input type='text' name='firstname' placeholder='first name'>
            <input type='text' name='lastname' placeholder='last name'>
            <input type='email' name=email placeholder='email adress'>
            
            <input type='submit' value='Send'>
        </form>
    ";

    if (!empty($_POST["firstname"]) and !empty($_POST["lastname"]) and !empty($_POST["email"])){
//#region    ----------------------------------SQL CONNECT------------------------------------------
        include('login.php');
        $conn = mysqli_connect($host, $user, $password);
        if (!$conn){
            die('DB CONNECTION FAILED >>>'.mysqli_connect_error());
        }else {
            mysqli_select_db($conn, $database);
            echo 'OK<br>';
        }
//#endregion    ----------------------------------SQL CONNECT------------------------------------------

        $sql = 'CREATE TABLE IF NOT EXISTS hotel (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(20) NOT NULL ,
        lastname VARCHAR(20) NOT NULL ,
        email VARCHAR(30),
        regdate TIMESTAMP
    )';

        if (mysqli_query($conn, $sql)){
            echo 'TABLE DONE :) <br>';
        }else{ echo 'PROBLEM >>> '.mysqli_error();}

        $sql = "INSERT INTO hotel (firstname, lastname, email) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."')";
        if (mysqli_query($conn, $sql)){
            echo 'ÚJ REKORD FELVÉVE <br>';
        }else{ echo 'PROBLEM >>> '.mysqli_error();}
        mysqli_close($conn);
    }
    else{
        echo 'NOPE... még van kitöltendő mező!!!';
    }

?>