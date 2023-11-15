<?php
    echo "
        <form action='' method='POST'>
            <input 
                type='text'
                placeholder='név..'
                name='name'
            ><br>
            
            <input 
                type='text'
                name='email'
                placeholder='email..'
            ><br>
            
            <textarea
                placeholder='üzenet..'
                name='message'
                rows='5'
                cols='30'
            ></textarea><br>
            
            <input 
                    type='submit'
                    value='OK'
                >
        </form>
    ";

    function olvasEsKiir ($path){
        $fa = fopen($path, 'r') or die('ERROR: Hiba a file olvasásakor');

        $text = '';

        while(!feof($fa)){
            $text = fgets($fa, 800);
            echo $text.'<br>';
        }
        fclose($fa);
    }

    if (!empty($_POST['name'])&& !empty($_POST['message']) && !empty($_POST['email'])){
        $myFile = 'vendeg.txt';
        if (!is_file($myFile)){
            touch($myFile);
        }
        $fa = fopen($myFile, 'a') or die('ERROR: Megnyitásnál');

        fwrite($fa, 'név: '.$_POST['name']."\n");
        fwrite($fa, 'e-mail: '.$_POST['email']."\n");
        fwrite($fa, 'üzenet: '.$_POST['message']."\n\n");

        fclose($fa);

        olvasEsKiir($myFile);
    }
?>
