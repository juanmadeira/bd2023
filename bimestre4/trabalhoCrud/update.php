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
    </main>
</body>