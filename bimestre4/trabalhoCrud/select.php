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
            $result = pg_query($connection, "SELECT * FROM itens");
            if(isset($_GET['id']) != null) {
                pg_query($connection, "DELETE FROM itens WHERE id =".$_GET['id'].";");
            }
        ?>

        <table>
            <p>Itens</p>
            <th>
                <tr>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                </tr>
            </th>
                <?php
                    $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
                    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                    $result = pg_query($connection, "SELECT * FROM itens");

                    if (!$result) {
                        echo "Erro na consulta.<br>";
                        exit;
                    }

                    while ($row = pg_fetch_row($result)) {
                        echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td><a href='select.php?id=".$row[0]."' class='tabelado'>EXCLUIR</a></td></tr>";
                    }
                ?>
        </table>

        <table>
            <p>Maior preço</p>
            <th>
                <tr>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                </tr>
            </th>
                <?php
                    $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
                    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                    $result = pg_query($connection, "SELECT * FROM itens WHERE vl = (SELECT MAX(vl) FROM itens);");

                    if (!$result) {
                        echo "Erro na consulta.<br>";
                        exit;
                    }

                    while ($row = pg_fetch_row($result)) {
                        echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                    }
                ?>
        </table>

        <table>
            <p>Menor preço</p>
            <th>
                <tr>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                </tr>
            </th>
                <?php
                    $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
                    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                    $result = pg_query($connection, "SELECT * FROM itens WHERE vl = (SELECT MIN(vl) FROM itens);");

                    if (!$result) {
                        echo "Erro na consulta.<br>";
                        exit;
                    }

                    while ($row = pg_fetch_row($result)) {
                        echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                    }
                ?>
        </table>

        <table>
            <p>Fora do estoque</p>
            <th>
                <tr>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                </tr>
            </th>
                <?php
                    $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
                    if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                    $result = pg_query($connection, "SELECT * FROM itens WHERE qt = 0;");

                    if (!$result) {
                        echo "Erro na consulta.<br>";
                        exit;
                    }

                    while ($row = pg_fetch_row($result)) {
                        echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                    }
                ?>
        </table>

        <div class="container">
            <a href="index.html"><input type="button" value="VOLTAR"></a>
        </div>
    </main>
</body>