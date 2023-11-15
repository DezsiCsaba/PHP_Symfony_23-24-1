<?php
    class Car{
//        var -> public adattag követi
//        ha nem írunk elé semmi alapvetően public
        var $rendzsam;
        var $szin;
        var $ar;


        public function __construct($a,$b,$c=2000000){
            $this->rendzsam = $a;
            $this->szin = $b;
            $this->ar = $c;
        }
        public function __destruct(){
            echo "Ezt az autót lezártuk: $this->rendzsam <br>";
        }
        public function __clone(){
            $this->ar *= 1.1;
        }
        public function kiir(){
            echo "$this->rendzsam $this->szin $this->ar<br>";

        }
    }

    class Os{
        var $s;

        public function novel(){
            echo $this->s*2 ."<br>";
        }
        public function __construct($ins){
            $this->s=$ins;
        }
    }

    class Utod extends Os{
        var $s;

        public function novel(){
            echo $this->s*3 ."<br>";
        }
        public function __construct($ina)
        {
            parent::__construct($ina);
        }
    }


//    $fiat = new Car('BBB-000', 'kek', 3000000);
    $mercedes = new Car('CCC-000', 'zold');

//    $fiat -> kiir();
    $mercedes -> kiir();
    $honda = clone $mercedes;
    $honda->kiir();

    if ($honda instanceof Car) echo "igen, Car<br>";
    else echo "nem Car<br>";
    if ($honda instanceof Os) echo "igen, Os<br>";
    else echo "nem Os<br>";

//    $obj = new Os(4);
//    $obj->novel();
//    $obje = new Utod(4);
//    $obje->novel();

?>

