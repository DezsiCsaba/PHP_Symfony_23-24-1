<?php
    interface IHivas{
        public function Hivas($perc, $szolgaltato);
    }

    class Telefon implements IHivas {
        var $szolgaltato = 'vodafone';
        private $telefonszam = '1-234-5678';
        var $egyenleg;

        public function __construct($egyenleg = 10000){
            $this->egyenleg = $egyenleg;
        }

        public function Hivas($perc, $szolgaltato){
            if ($this->szolgaltato === $szolgaltato) $this->egyenleg -= $perc * 2;
            else $this->egyenleg -= $perc * 4;
        }
    }

    class Mobil extends Telefon{
        var $feltoltottseg = 100;

        public function Hivas($perc, $szolgaltato){
            parent::Hivas($perc, $szolgaltato);
            $this->feltoltottseg -= $perc;
        }
    }


    $a = new Telefon();
    $a->Hivas(12, 'vodafone');
    echo "Az 'a' telefon hívás utáni egyenlege: ".$a->egyenleg.' ft<br>';

    $b = new Mobil();
    $b->Hivas(3, 'd-telekom');
    echo "A huawei mobil infói:<br>";
    echo "egyenleg: ".$b->egyenleg ." ft, töltöttsége: ".$b->feltoltottseg.'%';

    $honor = clone $b
?>