<?php
    include('login.php');
    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn){
        die('DB CONNECTION FAILED >>>'.mysqli_connect_error());
    }
    else{
        echo 'sikeres kapcsolat';
    }


    $sql = "SELECT * FROM emberek";
    if ($res = mysqli_query($conn, $sql)){
        $fields = mysqli_num_fields($res);
        $rows = mysqli_num_rows($res);

//        echo 'mezők száma: '.$fields .', sorok száma: '.$rows;

        echo "<table border='1px'>";
            echo "<tr>";
                for ($i = 0; $i < $fields; $i++){
                    $fieldInfo = mysqli_fetch_field($res);
                    printf("<td> %s </td>", $fieldInfo->name);
                }
            echo "</tr>";

            while ($record = mysqli_fetch_assoc($res)){
                echo "<tr>";
                    foreach ($record as $data){
                        echo "<td> $data </td>";
                    }
                echo "</tr>";
            }
        echo "</table>";


    }
    else{echo 'NOPE >>>'.mysqli_error();}


    mysqli_data_seek($res, 1);
    $row = mysqli_fetch_row($res);
    echo "<br><br><table border='1px'>";
        echo "<tr>";
            foreach ($row as $data){
                echo "<td> $data </td>";
            }
        echo '</tr>';
    echo "</table>";

    mysqli_close($conn)
?>