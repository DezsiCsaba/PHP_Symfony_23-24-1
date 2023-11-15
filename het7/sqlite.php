<?php
$db = new sqlite3('database.db') or die ('[ERROR] no db file created');

$query = "CREATE TABLE IF NOT EXISTS uzenet(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    kuld VARCHAR(20),
    cimzett VARCHAR(20),
    szoveg TEXT,
    time DATETIME DEFAULT CURRENT_TIMESTAMP
)";
$db->exec($query) or die ("[ERROR] no table created");

$sql = "INSERT INTO uzenet(kuld, cimzett, szoveg) VALUES ('dezsics@ahrt.hu', 'kormkr@ahrt.hu', 'helo')";
$db->exec($sql) or die ('[ERROR] no lekérdezés');

$sql = "SELECT * FROM TABLE uzenet";
$table = $db->exec($sql);

//echo "<table border='1px'>";
//while ($row < ){
//    echo "<tr>";
//    foreach ($record as $data){
//        echo "<td> $data </td>";
//    }
//    echo "</tr>";
//}
//echo "</table>";

?>