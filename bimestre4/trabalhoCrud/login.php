<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style.css" />
    <title>the amazing digital library</title>
</head>
<body>
    <main>
        <?php
            $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
            if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

            $selectUsuarios = pg_query($connection, "SELECT email, senha FROM usuario");
            while($usuarios[] = pg_fetch_row($selectUsuarios));
            
            $selectIds = pg_query($connection, "SELECT id FROM usuario");
            while($ids[] = pg_fetch_row($selectIds));

            if($_POST['naomexer'] == "true") {
                for ($i=0; $i < count($ids) ; $i++) { 
                    if ($usuarios[$i][0] == $_POST['usu'] && $usuarios[$i][1] == $_POST['se']) {
                        echo "sexooo";
                    }
                }
            }

            // echo count($ids);
            // echo "<br>";
            // echo $ids[0][0];
            // echo "<br>";
            // echo $ids[1];
            // echo $ids[2];
            // echo $ids[3];
            // echo $ids[4];

            // echo "<br>";
            // echo count($usuarios);
            // echo "<br>";
            // echo $usuarios[0][0];
            // echo "<br>";
            // echo $usuarios[0][1];
            // echo "<br>";
            // echo $usuarios[1];
            // echo "<br>";
            // echo $usuarios[2];
            // echo "<br>";
            // echo $usuarios[3];
            // echo "<br>";
        ?>

        <form action="login.php" method="post">
            <div class="container">
                <label for="usu">Email:</label>
                <input type="email" id="usu" name="usu"></input>
            </div>

            <div class="container">
                <label for="se">Senha:</label>
                <input type="password" id="se" name="se"></input>
            </div>

            <div class="container">
                <input type="submit" value="LOGAR">
                <input type="hidden" name="naomexer" value="true">
            </div>

            <div class="container">
                <a href="menu.html"><input type="button" value="VOLTAR"></a>
            </div>
        </form>    
    </main>
</body>