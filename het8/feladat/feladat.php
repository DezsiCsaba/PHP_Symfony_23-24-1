<?php

$xmlData = simplexml_load_file('emberek.xml');

class ember{}
$emberArray = array();
foreach ($xmlData->children() as $people){
    $e = new ember();
    foreach ($people->children() as $person){
        $asd = $person->getName();
        $val = $person->__toString();
        $e->$asd = $val;
    }
    print_r($e);
    echo '<br>';
    array_push($emberArray,$e);
}
file_put_contents(
    'emberek.json',
    json_encode($emberArray, JSON_PRETTY_PRINT)
);
echo '<br>Conversion complete! :)';
echo '<pre>'.json_encode($emberArray, JSON_PRETTY_PRINT).'</pre>';
?>