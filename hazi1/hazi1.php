<?php
//    include 'hazi1.html';

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
    function getVotes($datas){
        $votes = [];
        $i = 0;
        foreach ($datas as $data) {
            $votes[$i] = $data->votes;
            $i++;
        }
        return $votes;
    }
    function getHighestVotes($datas, $voteArray){
        $maxi = array_keys($voteArray, max($voteArray));
        return $datas[$maxi[0]]->name;
    }
    function getAllVotes($voteArray){
        $votes = 0;
        foreach ($voteArray as $item) {
            $votes += $item;
        }
        return $votes;
    }
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


    echo "
    <body class='body'>


        <link rel='stylesheet' href='style.css'
        <div >
            <h2>Szavazz!</h2>
            <form method='post' action='' class='site-container'>
                <div class='zone'>
                    <h3>Melyik a legnehezebb boss a 3 közül?</h3>
                    <br><label>
                        <input
                                checked
                                type='radio'
                                name='boss'
                                value='1'
                        >
                        Godrick the Grafted
                    </label><br>
                    <label>
                        <input
                                type='radio'
                                name='boss'
                                value='2'
                        >
                        Morgott the Omen King
                    </label><br>
                    <label>
                        <input
                                type='radio'
                                name='boss'
                                value='3'
                        >
                        Malenia, Blade Of Miquella
                    </label><br>
        
                    <input
                            type='submit'
                            value='OK'
                            class='zone-btn'
                    >
                </div>
        
                <div class='zone'>
                    <h3>Szavazás állása:</h3>
                    <div class='progBar-container'>
                        <label>Godrick the Grafted
                            <progress
                                    max='$allVoteVal'
                                    value='$votes[0]'
                            >
                            </progress>
                        </label><br>
                        <label>Morgott the Omen King
                            <progress
                                    max='$allVoteVal'
                                    value='$votes[1]'
                            >
                            </progress>
                        </label><br>
                        <label>Malenia, Blade Of Miquella
                            <progress
                                    max='$allVoteVal'
                                    value='$votes[2]'
                            >
                            </progress>
                        </label><br>
                    </div>
        
        
                    <div class='result'>
                        Jelenleg nyerésre áll: $highestVoted
                    </div>
                </div>
        
            </form>
        </div>
    </body>
    ";



?>