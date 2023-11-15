<?php
    class StatikusOsztaly{
        public static $v1 = 'tartalom';

        public static function kiir(){
            echo self::$v1."<br>";
        }
    }

    StatikusOsztaly::kiir();
    StatikusOsztaly::$v1 = 'ez már át van írva';
    StatikusOsztaly::kiir();

?>
