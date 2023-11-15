<?php
    function olvas ($path){
        $fa = fopen($path, 'r') or die('ERROR: Hiba a file olvasásakor');

        $text = '';

        while(!feof($fa)){
            $text = fgets($fa, 800);
            echo $text.'<br>';
        }
        fclose($fa);
    }


    $fileom="szoveg.txt";
    touch($fileom);

    if ($fa = fopen($fileom, 'w')){
       fwrite($fa, "Dézsi Csaba \n");
       fwrite($fa, "web fejlesztés \n");

       echo 'Fileba írás sikeres volt <br>';
    }
    else {
        echo 'ERROR: Hiba a file írásakor';
    }
    fclose($fa);



    olvas($fileom);

    $fa = fopen($fileom, 'a') or die('ERROR: Hiba a file kiegészítése közben!');
    fwrite($fa, "Hozzáírt szöveg:\n");
    fwrite($fa, "extra szöveg \n");
    fclose($fa);

    olvas($fileom);

    $fa = fopen($fileom, 'r') or die('ERROR: Hiba a navigációnál');
    fseek($fa, 2);
    $text = fread($fa, 3);
    echo '<br>' .$text;

?>
