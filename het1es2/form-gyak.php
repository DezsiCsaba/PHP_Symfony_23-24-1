<?php



if (!empty($_POST['nev']) && !empty($_POST['msg'])){
    echo $_POST['nev'].'<br>';
    echo $_POST['msg'].'<br>';
}
else{
    echo 'empty fields!';
}
?>