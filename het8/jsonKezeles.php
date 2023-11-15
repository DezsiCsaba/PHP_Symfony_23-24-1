<?php

//#region alap JSON kezelo dolgok
//fileba iras 1
$people = array('name'=>'Zoli', 'age'=>23, 'married'=>true);
echo '<pre>'.json_encode($people, JSON_PRETTY_PRINT).'</pre>';
file_put_contents('elso.json', json_encode($people, JSON_PRETTY_PRINT), JSON_PRETTY_PRINT);

//olvasas
$jsonPeople = file_get_contents('elso.json');
echo '<br>Ez a beolvasott file:<br>';
print_r($jsonPeople);

//JSON object
echo '<br><br>JSON obj-ból tömb:';
$jsonObj = '{"Peter": 23, "Ben": 33, "Joe": 50}';
$jsonArray = json_decode($jsonObj);
foreach ($jsonArray as $key=>$data){
    echo '<br>'.$key .' => ' .$data;
}
//fileba iras 2
$fp = fopen('masodik.json', 'w');
fwrite($fp, json_encode($people, JSON_PRETTY_PRINT));
fclose($fp);
//#endregion

//#region JSON validation
$string = "{'Peter':35, 'Ben':12, 'Mary':22}"; //hiba, mert nem idézőjeles
$string = '{"Butor":"szekreny", "Auto":"honda"}'; //hibátlan
$string = '{"Peter": 23, "Ben": 33, "Joe": 50, "adress": ["city", "22nd]}'; //street-nél hiányzó 2. "-jel

$array = json_decode($string);
echo '<br><br> [ERROR]:';
switch (json_last_error()){
    case JSON_ERROR_NONE:
        echo 'You good bro';
        break;
    case JSON_ERROR_DEPTH:
        echo 'Méylségi hiba';
        break;
    case JSON_ERROR_STATE_MISMATCH:
        echo 'Nem megfelelő formátum';
        break;
    case JSON_ERROR_CTRL_CHAR:
        echo 'controll karakter hiba';
        break;
    case JSON_ERROR_SYNTAX:
        echo 'syntax hiba!';
        break;
    case JSON_ERROR_UTF8:
        echo 'Nem UTF-8as karaktert tartalmaz';
        break;
    default:
        echo 'unknown error';
        break;
}

//#endregion

//class entityből JSON-be
class Emp{
    public $name = '';
    public $hobbies = '';
    public $birthday = '';
}
$e = new Emp();
$e->name = 'Joe';
$e->hobbies = 'sports';
$e->birthday = date('m.d.y h:m:s', strtotime('11/10/2023 16:23:00'));

$jsonObj2 = json_encode($e, JSON_PRETTY_PRINT);
echo '<pre>'.$jsonObj2,'</pre>';
?>