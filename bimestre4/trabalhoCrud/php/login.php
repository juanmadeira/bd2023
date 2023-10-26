<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>

    <style>
        body {
            background-color: black;
            color: crimson;
            font-family: sans-serif;
            
        }

        .container {
            display: flex;
            flex-flow: column wrap;
            align-items: center;
            align-content: center;
            margin-top:2.5%
        }

        label {
            font-size: 115%;
            font-weight: bold;
        }

        input[type="text"] {
            background-color: black;
            border: crimson solid 2pt;
            outline: none;
            border-radius: 3.5%;
            color: crimson;
        }

        input[type="submit"], input[type="button"] {
            background-color: crimson;
            border: solid crimson 1pt;
            border-radius: 50%;
            color: black;
            font-weight: bold;
            font-size: 90%;
            margin-top: 3%;
            width: 50pt;
            height: 50pt;
            padding:0.1%;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            animation: color 0.5s forwards;
        }
        @keyframes color{
            from{
                background-color: crimson;
                border: solid crimson 0.1pt;
            }
            to{
                background-color: rgb(247, 83, 116);
                border: solid rgb(247, 83, 116) 0.1pt;
            }
        }
    </style>
</head>


<body>

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
</body>