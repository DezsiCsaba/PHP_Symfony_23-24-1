<!DOCTYPE html>
<html>
    <head>
        <script lang="js">
            function testResult(x){
                alert('x értéke: ' + x)
            }
            function kiir(y){
                document.getElementById('bekezdes').innerHTML = y
            }
        </script>
    </head>

    <body>
        <form action="" method="GET">
            Gimme adat:
            <input
                type="text"
                name="tf"
            ><br>
            Gimme more adat:
            <input
                type="text"
                name="tf2"
            ><br>

            <input
                type="Submit"
                value="Submit"
            >
            <p id="belezdes"></p>
        </form>
        <?php
            if (!empty($_POST['tf']) && !empty($_POST['tf2'])){
                echo "
                    <script lang='js'>
                        let x = '$_GET[tf]'
                        testResult(x)
                    </script>
                ";
            }
        ?>
    </body>
</html>