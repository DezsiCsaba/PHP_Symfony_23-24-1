<?php
    function kiir($input){
        echo $input.'<br>';
    }

    function osszeAd($a, $b){
        kiir($a + $b);
    }

    function osztas($a, $b=2){
        kiir($a/$b);
    }

    function globalis(){
        $v1 = 22;
        global $g;
        $g= 12;
        kiir($v1+$g);
    }

    osszeAd(10, 13);
    osztas(10);
    osztas(10, 2);
    globalis();
?>