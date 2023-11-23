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

        session_cache_expire(30);
        $cache_expire = session_cache_expire();

        session_start();

         foreach ($_SESSION as $key=>$val) echo $key." ".$val."<br/>";

        if ($_SESSION['type'] != 'adm') {
            header("location: index.php");
        }

        $result = pg_query($connection, "SELECT * FROM livro WHERE id=".$_POST['livroId'].";");

        if (!$result) {
            echo "Erro na consulta.<br>";
            exit;
        }

        $row = pg_fetch_row($result);

        echo "<form action='telaadm.php' method='post'>
        <div class='container'>
            <label for='nome'>Autores:</label>
            <input type='text' id='autores' name='autores' value='".$row[1]."'></input>
        </div>

        <div class='container'>
            <label for='email'>Titulo:</label>
            <input type='text' id='titulo' name='titulo' value='".$row[2]."'></input>
        </div>

        <div class='container'>
            <label for='email'>Imagem:</label>
            <input type='text' id='imagem' name='imagem' value='".$row[3]."'></input>
        </div>

        <div class='container'>
            <label for='email'>Ano:</label>
            <input type='text' id='ano' name='ano' value='".$row[4]."'></input>
        </div>

        <div class='container'>
            <label for='email'>Editora:</label>
            <input type='text' id='editora' name='editora' value='".$row[5]."'></input>
        </div>

        <div class='container'>
            <label for='email'>Quantidade:</label>
            <input type='text' id='quantidade' name='quantidade' value='".$row[6]."'></input>
        </div>

        <div class='container'>
            <input type='submit' value='ATUALIZAR'>
        </div>

        <input type='hidden' id='updatedLivroId' name='updatedLivroId' value='".$row[0]."'>
    </form>";
    ?>
</body>