<?php
    echo "
        <form action='' method='POST'>
            <label>Név</label><br>
            <input 
                type='text'
                name='name'
            ><br>
            
            Kérlek add meg a nemedet!<br>
            <input type='radio' name='gender' value='1' checked> nő<br>
            <input type='radio' name='gender' value='2'> férfi<br>
            
            <label>Üzenet</label><br>
            <textarea
                name='message'
                rows='5'
                cols='30'
            ></textarea><br>
            
            Szavazz!<br>
            <input type='radio' name='vote' value='1' checked> Brian<br>
            <input type='radio' name='vote' value='2'> Mary<br>
            <input type='radio' name='vote' value='3'> Rose<br>
            
            
            <label><input type='checkbox' name='store[]' value='pizza'>pizza</label><br>
            <label><input type='checkbox' name='store[]' value='hamburger'>hamburger</label><br>
            <label><input type='checkbox' name='store[]' value='rántotthús'>rántotthús</label> <br>
            
            Válassz autót<br>
            <select name='cars'>
                <option value='Fiat' selected> Fiat</option>
                <option value='Honda'>Honda</option>
                <option value='Kia'>Kia</option>
                <option value='Volkswagen'>Volkswagen</option>
            </select><br>
            
            <div class='actions'>
                <input 
                    type='submit'
                    value='OK'
                >
                <input 
                    type='reset'
                    value='TÖRÖL'
                >
            </div>
            
</form>
    ";
    if (!empty($_POST['name'])&& !empty($_POST['message']) && !empty($_POST['store'])
        && !empty($_POST['cars'])
    ){
        echo "Név: ".$_POST['name']."<br>";
        echo "Üzenet: ".$_POST['message']."<br>";

        switch ($_POST['gender']){
            case 1:
                echo 'Ön nő';
                break;
            case 2:
                echo 'Ön férfi';
                break;
        }
//        switch ($_POST['vote']){
//            case 1:
//                echo 'Briant választottad';
//                break;
//            case 2:
//                echo 'Maryt választottad';
//                break;
//            case 3:
//                echo 'Roset választottad';
//                break;
//        }
        echo '<br>Az alábbi ételeket választottad:<br>';
        foreach ($_POST['store'] as $item) {
            echo $item.', ';
        }

        echo '<br>Az alábbi autót választottad: '.$_POST['cars'] .'<br';
    }
    else{
        echo "Még van üres mező";
    }
?>
