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

        img {
            display: inline-block;
            width:100%;
            height:100%;
        }

        .tabelado {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <?php
        session_cache_expire(30);
        $cache_expire = session_cache_expire();
    
        session_start();
    
        foreach ($_SESSION as $key=>$val) echo $key." ".$val."<br/>";
    
        if ($_SESSION['type'] != 'user') {
            header("location: index.php");
        }
    
        $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
        if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");
    
        if($_POST['livroId'] != null && $_POST['local'] == "usuario") {
            $date = date('d m Y h:i', time());
            pg_query($connection, "INSERT INTO emprestimo (tempo, idusuario, idlivro) VALUES ('".$date."',".$_SESSION['userid'].",".$_POST['livroId'].");");
            header("location: blank.php");
        }
    
        $selectEmprestimos= pg_query($connection, "SELECT l.titulo FROM emprestimo JOIN livro l ON idlivro = l.id WHERE idusuario = ".$_SESSION['userid'].";");
    
        if (!$selectEmprestimos) {
            echo "Erro na consulta.<br>";
            exit;
        }
    
        while($emprestimos[] = pg_fetch_row($selectEmprestimos));
    
        if (count($emprestimos) == 1) {
            echo 'Nenhum livro em posse';
        } else {
            for ($i=0; $i < count($emprestimos); $i++) { 
                echo "<tr><td>".$emprestimos[$i][0]."</td></tr></br>";
            }
        }
    
    
    
        $selectLivros= pg_query($connection, "SELECT titulo, imagem, id FROM livro");
    
        if (!$selectLivros) {
            echo "Erro na consulta.<br>";
            exit;
        }
    
        while ($livros = pg_fetch_row($selectLivros)) {
            echo "<table>
                <tr>
                    <td>".$livros[0]."</td>
                    <td><img src='".$livros[1]."'></td>
                    <td>
                        <form method='post' action='telausuario.php' >
                            <input type='hidden' id='livroId' name='livroId' value='".$livros[2]."'>
                            <input type='hidden' name='local' value='usuario'>
                            <input type='submit' value='ALUGAR'>
                        </form>
                    </td>
                </tr>
            </table>";
        }
    
    ?>
    
    <div class="container">
        <a href="redirect.php"><input type="button" value="SAIR"></a>
    </div>
</body>