<?php

/**File olvasása
 * @param $path
 * @return string|void
 */
function read ($path){
    $fa = fopen($path, 'r') or die('ERROR: Hiba a file olvasásakor');

    $text = '';

    while(!feof($fa)){
        $text .= fgets($fa, 800);
    }
    fclose($fa);
    return $text;
}


/** decode-olja a json data-t
 * @param $path
 * @return mixed
 */
function readFromJSON($path){
    $rawDatas = read($path);
    return json_decode($rawDatas);
}


/** konkrét változó kiolvasása a JSON-ból
 * @param $datas - JSON adat
 * @return array
 */
function getVotes($datas){
    $votes = [];
    $i = 0;
    foreach ($datas as $data) {
        $votes[$i] = $data->votes;
        $i++;
    }
    return $votes;
}


/** Maximum értékű elem visszaadása egy tömbből
 * @param $datas
 * @param $voteArray
 * @return mixed
 */
function getHighestVotes($datas, $voteArray){
    $maxi = array_keys($voteArray, max($voteArray));
    return $datas[$maxi[0]]->name;
}


/** JSON file-ba adat írás
 * @param $datas> input data
 * @param $path> mentés helye
 * @return void
 */
function saveToJSON($datas, $path){
    $jsonString = json_encode($datas, JSON_PRETTY_PRINT);

    $fp = fopen($path, 'w');
    fwrite($fp, $jsonString);
    fclose($fp);
}


$datas = readFromJSON('datas.json');
$votes = getVotes($datas);
$highestVoted = getHighestVotes($datas, $votes);
$allVoteVal = getAllVotes($votes);

/**
ehhez hasonlóan lehet inputból adatváltoztatni:
a JSON file = ./datas.json
 **/
if(!empty($_POST['boss'])){
    switch ($_POST['boss']){
        case 1:
            $votes[0] += 1;
            $datas[0]->votes +=1;
            break;
        case 2:
            $votes[1] += 1;
            $datas[1]->votes +=1;
            break;
        case 3:
            $votes[2] += 1;
            $datas[2]->votes +=1;
            break;
    }
    saveToJSON($datas, 'datas.json');
}

?>