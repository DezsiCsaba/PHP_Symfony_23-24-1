<?php
    include('login.php');

    #region >>> form
    echo "
        <body>
            <form action='' method='POST'>
                <input type='text' name='nev', placeholder='Name..'><br>
                <input type='text' name='telszam', placeholder='Phone num..'><br>
                <input type='text' name='cim', placeholder='Adress..'><br>
                
                <br>
                <input name='create' type='submit' value='Create new'>
                <input name='getOne' type='submit' value='Find above'>
                <input name='getAll' type='submit' value='List all'>
            </form>
        </body>
    ";
    #endregion

    #region >>> SQL-CONNECT
$conn = mysqli_connect($host, $user, $password);
if (!$conn){
    die('DB CONNECTION FAILED >>>'.mysqli_connect_error());
}else {
    mysqli_select_db($conn, $database);
    echo 'DB CONN ESTABLISHED<br>';
}
#endregion

    #region >>> CREATE-TABLE
$create = 'CREATE TABLE IF NOT EXISTS telefonkonyv (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL ,
            phoneNum VARCHAR(50) NOT NULL ,
            adress VARCHAR(50) NOT NULL,
            ts TIMESTAMP
        )';
if (mysqli_query($conn, $create)){
    echo "TABLE 'telefonkonyv' DONE :) <br>";
}else{ echo 'PROBLEM >>> '.mysqli_error();}
#endregion

    if (!empty($_POST['nev']) and !empty($_POST['telszam']) and !empty($_POST['cim'])){
        #region >>> ADD-FIELD
        if (!empty($_POST['create'])){
            $insert = "INSERT INTO telefonkonyv (name, phoneNum, adress) VALUES ('".$_POST['nev']."','".$_POST['telszam']."','".$_POST['cim']."')";
            if (mysqli_query($conn, $insert)){
                echo 'ÚJ REKORD FELVÉVE <br>';
            }else{ echo 'PROBLEM >>> '.mysqli_error();}
        }
        #endregion

        ##region >>> GET-ALL
        if (!empty($_POST['getAll'])){
            getAll($conn);
        }
        #endregion
        mysqli_close($conn);
    }
    else if (!empty($_POST['nev'])){
        if (!empty($_POST['getOne'])){
            getOne($conn, 'name', $_POST['nev']);
        }
    }
    else if (!empty($_POST['telszam'])){
        if (!empty($_POST['getOne'])){
            getOne($conn, 'phoneNum', $_POST['telszam']);
        }
    }
    else if (!empty($_POST['cim'])){
        if (!empty($_POST['getOne'])){
            getOne($conn, 'adress', $_POST['cim']);
        }
    }
    else{
        ##region >>> GET-ALL
        if (!empty($_POST['getAll'])){
            getAll($conn);
        }
        #endregion
        mysqli_close($conn);
    }

    function getAll($conn)
    {
        $sql = "SELECT * FROM telefonkonyv";
        if ($res = mysqli_query($conn, $sql)){
            $fields = mysqli_num_fields($res);
            $rows = mysqli_num_rows($res);

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
    }

    function getOne($conn, $field, $like){
//        $getOne = "SELECT * FROM `telefonkonyv` WHERE `name` LIKE '".$_POST['nev']."'";
        $getOne = "SELECT * FROM `telefonkonyv` WHERE `$field` LIKE '".$like."'";

        if ($res = mysqli_query($conn, $getOne)){
            $fields = mysqli_num_fields($res);

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
        }else{ echo 'PROBLEM >>> '.mysqli_error();}
    }

?>