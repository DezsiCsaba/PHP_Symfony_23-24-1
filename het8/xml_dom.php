<?php
$employees = array();
$employees[]=array(
    'name'=>'Bela',
    'age'=>22,
    'salary'=>2300000
);
$employees[]=array(
    'name'=>'Eva',
    'age'=>19,
    'salary'=>560000
);
$employees[]=array(
    'name'=>'Jozsi',
    'age'=>32,
    'salary'=>660000
);

//foreach ($employees as $emp){
//    foreach ($emp as $data){
//        echo $data.' ';
//    }
//    echo '<br>';
//}

//#region DOC
$doc = new DOMDocument();
$doc->formatOutput = true; //ha true akkor megformázza a DOM-ot, olyanra amilyet éppen belerakunk
$rootEl = $doc->createElement('employees');
$doc->appendChild($rootEl);

foreach ($employees as $employee){
    $childEl = $doc->createElement('people');

    //létrehozunk egy adat elementet
    $name = $doc->createElement('name');
    $age = $doc->createElement('age');
    $salary = $doc->createElement('salary');

    //az adat elementet hozzáadjuk textNode-ként
    $name->appendChild($doc->createTextNode($employee['name']));
    $age->appendChild($doc->createTextNode($employee['age']));
    $salary->appendChild($doc->createTextNode($employee['salary']));

    //appendeljük a parent elementhez a textNode-os adatunkat
    $childEl->appendChild($name);
    $childEl->appendChild($age);
    $childEl->appendChild($salary);

    //a roothoz hozááadjuk az egészet
    $rootEl->appendChild($childEl);
}
echo $doc->saveXML();
$doc->save('emberek.xml');
//#endregion

//#region DOC2
$doc2 = new DOMDocument();
$doc2->load('emberek.xml');
$emberek = $doc2->getElementsByTagName('people');

echo '<br><br>Betoltott adatok:<br>';
foreach ($emberek as $ember){
    //az element egy elementjét szedjük ki
    $neve = $ember->getElementsByTagName('name');
    $kora = $ember->getElementsByTagName('age');
    $fizetese = $ember->getElementsByTagName('salary');

    //az element adatát szedjük ki
    $nev = $neve->item(0)->nodeValue;
    $kor = $kora->item(0)->nodeValue;
    $fizetes = $fizetese->item(0)->nodeValue;

    echo '<span>>>>'.$nev .', '.$kor.', '.$fizetes.'</span><br>';
}
//#endregion

//#region import dom as xml
echo '<br>';
$xml = simplexml_import_dom($doc2);
foreach ($xml as $child){
    foreach ($child as $data){
        echo $data->getName().': '.$data.'<br>';
    }
}
//#endregion

?>