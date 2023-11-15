<?php
include('db-login.php');

//connect to MYSQL db:
///** @var TYPE_NAME $user */
///** @var TYPE_NAME $host */
///** @var TYPE_NAME $password */
///** @var TYPE_NAME $database */
//$conn = mysqli_connect($host, $user, $password, $database);
//if (!$conn) die('DB CONNECTION FAILED >>>'.mysqli_connect_error());
//else echo 'sikeres kapcsolat';

$meetings = getAllMeetingData();
displayMeetings($meetings);

$meeting = getMeetingData(0, $meetings);
displayMeetingTimes($meeting->napok);
$meetingName = $meeting->name;
$szervezo = $meeting->szervezo;
$helyszin = $meeting->helyszin;
$idopontok = $meeting->resztvevok;

echo "
<div style='display: flex; flex-direction: column'>
    <span>Meeting: $meetingName</span>
    <span>Szervező: $szervezo</span>
    <span>Helyszín: $helyszin</span>
";
echo "</div>";

function displayMeetings($meetings){
    echo "<table border='1px'>";
    for ($i=0; $i <= count($meetings)-1; $i++){
        echo "<tr>";
            echo "<td>";
            //sajnos a választós dolgot nem sikerült megoldani
                echo '<div @click="getMeetingData()">' .$meetings[$i]->name .'</div>';
            echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
function getMeetingData($index, $datas){
    for ($i=0; $i<=count($datas); $i++){
        if ($i == $index) return $datas[$i];
    }
    //    $getOne = "SELECT * FROM `meeting` WHERE `id` = '".$id."'";
//    if ($res = mysqli_query($conn, $getOne)){
//        $record = mysqli_fetch_assoc($res);
//        foreach ($record as $data){
//            array_push($array, $data);
//        }
//        return $array;
//    }else{echo 'DB_ERROR >>>'.mysqli_error();}
}
function getAllMeetingData(){
    $datas = readFromJSON('meetings.json');
//    $output = [];
//    $sql = "SELECT * FROM `meeting`";
//    if ($res = mysqli_query($conn, $sql)){
//        $rowNum = mysqli_num_rows($res);
//        for ($i=0; $i<=$rowNum; $i++){
//            $row = mysqli_fetch_row($res);
//            array_push($output, $row);
//        }
//    }
//    return $output;
    return $datas;
}

function displayMeetingTimes($daysArray){
    echo "
        <p>Időpontok</p>
        <table>
    ";
//    foreach ($daysArray as $napok){
//        echo "<tr>" .$napok->datum;
//        foreach ($napok->idopontok as $time){
//            echo '<td' .$time .'</td>';
//        }
//        echo "</tr>";
//    }
    echo "</table>";
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