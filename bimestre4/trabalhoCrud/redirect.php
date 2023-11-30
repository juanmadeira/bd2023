<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="./script/script.js" defer></script>
    <title>the amazing digital library</title>
</head>
<?php
    $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

    $selectUsuarios = pg_query($connection, "SELECT email, senha, isadm, id, nm FROM usuario");

    while($usuarios[] = pg_fetch_row($selectUsuarios));
        
    $selectIds = pg_query($connection, "SELECT id FROM usuario");
    while($ids[] = pg_fetch_row($selectIds));

    session_cache_expire(30);
    $cache_expire = session_cache_expire();

    session_start();

    $_SESSION['type'] = 'null';

    if ($_POST['local'] == "login") {
        if($_POST['se'] == $_POST['cse']){
            pg_query($connection, "INSERT INTO usuario (nm, email, senha) VALUES ('".$_POST['nome']."','".$_POST['mail']."','".password_hash($_POST['se'], PASSWORD_BCRYPT)."');");
            header("location: index.php");
        }
    }

    for ($i=0; $i < count($ids) ; $i++) { 
        if ($usuarios[$i][0] == $_POST['usu'] && password_verify($_POST['sen'], $usuarios[$i][1]) && $_POST['sen'] != '') {
            if ($usuarios[$i][2] == 1) {
                $_SESSION['userid'] = $usuarios[$i][3];
                $_SESSION['usernm'] = $usuarios[$i][4];
                $_SESSION['usermail'] = $usuarios[$i][0];
                $_SESSION['type'] = 'adm';
                header("location: adm.php");
            } else {
                $_SESSION['userid'] = $usuarios[$i][3];
                $_SESSION['usernm'] = $usuarios[$i][4];
                $_SESSION['usermail'] = $usuarios[$i][0];
                $_SESSION['type'] = 'user';
                header("location: usuario.php");
            }
        }
    }

    if ($_SESSION['type'] != 'adm' && $_SESSION['type'] != 'user') {
        session_destroy();
        session_abort();
        header("location: index.php");
    }
?>