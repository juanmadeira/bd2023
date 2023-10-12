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
            display:flex;
            flex-flow: column wrap;
            align-content:center;
        }

        .container {
            display: flex;
            flex-flow: column wrap;
            align-items: center;
            align-content: center;
            margin-top:2.5%
        }

        table {
            display: flex;
            flex-flow: column wrap;
            align-items: center;
            align-content: center;
            width: 25%;
        }

        td {
            background-color: crimson;
            color: black;
            border: solid black 1pt;
            padding: 3pt;
            text-align:center;
        }

        input[type="button"] {
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

        input[type="button"]:hover {
            animation: color 0.5s forwards;
        }

        @keyframes color {
            from{
                background-color: crimson;
                border: solid crimson 0.1pt;
            }
            to{
                background-color: rgb(247, 83, 116);
                border: solid rgb(247, 83, 116) 0.1pt;
            }
        }

        p {
            align-self:center;
        }

        .tabelado {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
    <?php
        $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
        if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

        $result = pg_query($connection, "SELECT * FROM itens");

        if(isset($_POST['deleteById']) != null) {
            pg_query($connection, "DELETE FROM itens WHERE id =".$_POST['deleteById'].";");
        }

        if(isset($_POST['updatedId']) != null) {
            pg_query($connection, "UPDATE itens SET nm = '".$_POST['nome']."', qt= '".$_POST['quan']."', vl= ".$_POST['pre']." WHERE id = ".$_POST['updatedId'].";");
        }
    ?>

	<table>
        <p>Itens</p>
        <th>
            <tr>
                <td>Nome</td>
                <td>Quantidade</td>
                <td>Valor</td>
                <td>Excluir</td>
                <td>Atualizar</td>
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
                    echo "<tr>
                            <td>".$row[0]."</td>
                            <td>".$row[1]."</td>
                            <td>".$row[2]."</td>
                            <td>".$row[3]."</td>
                            <td>
                                <form method='post' action='select.php' >
                                    <input type='hidden' id='deleteById' name='deleteById' value='".$row[0]."'>
                                    <input type='submit' value='EXCLUIR'>
                                </form>
                            </td>
                            <td>
                                <form method='post' action='update.php' >
                                    <input type='hidden' id='updateById' name='updateById' value='".$row[0]."'>
                                    <input type='submit' value='ATUALIZAR'>
                                </form>
                            </td>
                        </tr>";
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
</body>