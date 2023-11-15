<?php
//include('db-login.php');
//include('jsonHandler.php');

//connect to MYSQL db:
///** @var TYPE_NAME $user */
///** @var TYPE_NAME $host */
///** @var TYPE_NAME $password */
///** @var TYPE_NAME $database */
//$conn = mysqli_connect($host, $user, $password, $database);
//if (!$conn) die('DB CONNECTION FAILED >>>'.mysqli_connect_error());
//else echo 'sikeres kapcsolat';

echo "
  <body>
    <form method='post' action=''> 
        <div>
        <br><label>Felhasználónév</label><br>
            <input
                type='text'
                placeholder='felhasználónév..'
                name='uname'
            >
        <br><label>Jelszó</label><br>
            <input
                type='text'
                placeholder='jelszó..'
                name='pword'
            >    
        <br><input
            type='submit'
            value='Bejelentkezés'
        >
    </form>
  </body>  
";

//input lekezelése
if(!empty($_POST['uname']) and !empty($_POST['pword'])){
    $uname = $_POST['uname'];
    $pw = $_POST['pword'];
    validateUser($uname, $pw);
}else{ echo 'nem volt input'; }


function validateUser($unameIn, $pwIn){
//    $getOne = "SELECT * FROM `user` WHERE `userName` = '".$unameIn."' AND `password` = '".$pwIn."'";
//    if ($res = mysqli_query($conn, $getOne)){  //a query futtatása a 'if'-ben
//        $record = mysqli_fetch_assoc($res);
//        if (!empty($record)){
////            header("Location:meetingek.php");
////            exit();
//        }
//        else echo 'failed authentication';
//    }else{echo 'DB_ERROR >>>'.mysqli_error();}

    $datas = readFromJSON('users.json');
    foreach ($datas as $user){
        if ($user->username == $unameIn and $user->pw == $pwIn){
            header("Location:meetingek.php");
            exit();
        }
    }
}


function read ($path){
    $fa = fopen($path, 'r') or die('ERROR: Hiba a file olvasásakor');

    $text = '';

    while(!feof($fa)){
        $text .= fgets($fa, 800);
    }
    fclose($fa);
    return $text;
}
function readFromJSON($path){
    $rawDatas = read($path);
    return json_decode($rawDatas);
}
?>