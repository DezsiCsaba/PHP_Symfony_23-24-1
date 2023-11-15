<?php

try{
    $pdo = new PDO('sqlite:database.db');
    $sql="CREATE TABLE IF NOT EXISTS mailek(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name STRING,
        password STRING,
        email STRING
    )";

    $pdo->exec($sql);
    $sql = "INSERT INTO mailek(name, password, email) VALUES ('Dezsi', 'pw123', 'dezsics@ahrt.hu')";
    $pdo->exec($sql);
    $sql = "SELECT * FROM mailek";

    $table = $pdo->prepare($sql);
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

}catch (PDOException $err){
    echo $err->getMessage();
}

?>