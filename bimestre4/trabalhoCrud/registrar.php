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

            if ($_POST['naomexer'] == "true") {
                if($_POST['se'] == $_POST['cse']){
                pg_query($connection, "INSERT INTO usuario (nm, email, senha) VALUES ('".$_POST['nome']."','".$_POST['mail']."','".$_POST['se']."');");
                } else {
                    echo "erro :(" ;
                }
            }
        ?>

        <form action="registrar.php" method="post">
            <div class="container">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome"></input>
            </div>

            <div class="container">
                <label for="mail">Email:</label>
                <input type="email" id="mail" name="mail"></input>
            </div>

            <div class="container">
                <label for="se">Senha:</label>
                <input type="password" id="se" name="se"></input>
            </div>

            <div class="container">
                <label for="cse">Confirmar Senha:</label>
                <input type="password" id="cse" name="cse"></input>
            </div>

            <div class="container">
                <input type="hidden" name="naomexer" value="true">
                <input type="submit" value="CONFIRMAR">
            </div>

            <div class="container">
                <a href="menu.html"><input type="button" value="VOLTAR"></a>
            </div>
        </form>    
    </main>
</body>