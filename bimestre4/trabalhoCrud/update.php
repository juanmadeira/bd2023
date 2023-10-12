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
        $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
        if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

        $result = pg_query($connection, "SELECT * FROM itens WHERE id=".$_POST['updateById'].";");

        if (!$result) {
            echo "Erro na consulta.<br>";
            exit;
        }

        $row = pg_fetch_row($result);

        echo "<form action='select.php' method='post'>
        <div class='container'>
            <label for='nome'>Nome do Item:</label>
            <input type='text' id='nome' name='nome' value='".$row[1]."'></input>
        </div>

        <div class='container'>
            <label for='quan'>Quantidade:</label>
            <input type='text' id='quan' name='quan' value='".$row[2]."'></input>
        </div>

        <div class='container'>
            <label for='pre'>Preço:</label>
            <input type='text' id='pre' name='pre' value='".$row[3]."'></input>
        </div>

        <div class='container'>
            <input type='submit' value='ATUALIZAR'>
        </div>

        <input type='hidden' id='updatedId' name='updatedId' value='".$row[0]."'>
    </form>";
    ?>
</body>