<?php
    echo "
        <form method='get' action=''>
            <input
                type='text'
                name='nev'
                placeholder='name'
            ><br>
            <input 
                type='text'
                name='msg'
            ><br>
            <input
                type='submit'
                value='Send'
            >
        </form>
    ";
if (!empty($_POST['nev']) && !empty($_POST['msg'])){
    echo $_POST['nev'].'<br>';
    echo $_POST['msg'].'<br>';
}
else{
    echo 'empty fields!';
}
?>