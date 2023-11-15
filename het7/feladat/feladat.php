<?php
$people = <<<XML
<note>
    <people>
        <person>
            <fname>Jani</fname>
            <lname>McDonald</lname>
            <profession>teacher</profession>
            <subject>math</subject>
        </person>
        <person>
            <fname>Peter</fname>
            <lname>Griffin</lname>
            <profession>teacher</profession>
            <subject>P.E</subject>
        </person>
        <person>
            <fname>Chris</fname>
            <lname>Griffin</lname>
            <profession>teacher</profession>
            <subject>programming</subject>
        </person>
        <person>
            <fname>Brian</fname>
            <lname>Griffin</lname>
            <profession>teacher</profession>
            <subject>physics</subject>
        </person>
    </people>
</note>

XML;
$xml = new SimpleXMLElement($people);
$xml->saveXML('people.xml');

$xmlData = simplexml_load_file('people.xml');
$peopleArr = [];
foreach ($xmlData->children()->children() as $person){
    array_push($peopleArr, $person);
}
//foreach ($peopleArr as $person){echo $person->fname;}

$pdo = new PDO('sqlite:database.db');
$sql="CREATE TABLE IF NOT EXISTS people(
        id INTEGER PRIMARY KEY AUTOINCREMENT
    ,";

$person = $xmlData->children()->children();
foreach ($person->children() as $element){
    $sql .= $element->getName()." STRING,";
}
$sql=rtrim($sql, ',').");";
$pdo->exec($sql);

$insertSQL="";
foreach ($xmlData->children()->children() as $people){
    $insertSQL="INSERT INTO people(";
    foreach ($people->children() as $person){
        $insertSQL.=$person->getName().",";
    }
    $insertSQL=rtrim($insertSQL, ',').") VALUES (";
    foreach ($people->children() as $person){
        $insertSQL.="'$person',";
    }
    $insertSQL=rtrim($insertSQL, ',').")";
    echo $insertSQL;
    $row=$pdo->prepare($insertSQL);
    $row->execute();
}
//foreach ($peopleArr as $person){
//    $fName = $person->fname;
//    $lName = $person->lname;
//    $prof = $person->profession;
//
//    $sql = "INSERT INTO people(fname, lname, profession) VALUES ('$fName', '$lName', '$prof')";
//    $query = $pdo->prepare($sql);
//    $query->execute();
//}

$getAll = "SELECT * FROM people";
$table = $pdo->prepare($getAll);
$table->execute();

$table->setFetchMode(PDO::FETCH_ASSOC);
echo "<table border=1>";
while($row = $table->fetch()){
    echo "<tr>";
    foreach ($row as $data){
        echo "<td>" .$data."</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>