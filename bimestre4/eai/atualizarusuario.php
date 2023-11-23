
<?php
    $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

    session_cache_expire(30);
    $cache_expire = session_cache_expire();

    session_start();

        foreach ($_SESSION as $key=>$val) echo $key." ".$val."<br/>";

    if ($_SESSION['type'] != 'adm') {
        header("location: index.php");
    }

    $result = pg_query($connection, "SELECT id, nm, email FROM usuario WHERE id=".$_POST['updateById'].";");

    if (!$result) {
        echo "Erro na consulta.<br>";
        exit;
    }

    $row = pg_fetch_row($result);

    echo "<form action='telaadm.php' method='post'>
    <div class='container'>
        <label for='nome'>Nome:</label>
        <input type='text' id='nm' name='nm' value='".$row[1]."'></input>
    </div>

    <div class='container'>
        <label for='email'>Email:</label>
        <input type='text' id='mail' name='mail' value='".$row[2]."'></input>
    </div>

    <div class='container'>
        <input type='submit' value='ATUALIZAR'>
    </div>

    <input type='hidden' id='updatedId' name='updatedId' value='".$row[0]."'>
    </form>";
?>