<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="./script/script.js" defer></script>
    <title>USER | the amazing digital library</title>
</head>
<body>
    <main class="column-main">
        <div class="title-main">
            <img src="./img/book.gif" alt="gif de um livro" />
            <img src="./img/user.png" alt="adm title" />
        </div>
        <?php
            session_cache_expire(30);
            $cache_expire = session_cache_expire();

            session_start();

                echo "<div class='info'>";
                echo "Logado como <br>";
                echo "Nome: " . $_SESSION['usernm'] . '<br>';
                echo "Email: " . $_SESSION['usermail'];
                echo "</div>";

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
                echo "<div class='emprestimos'>Nenhum livro em posse.</div>";
            } else {
                echo "<div class='emprestimos'>";
                for ($i=0; $i < count($emprestimos); $i++) { 
                    echo "<tr><td>".$emprestimos[$i][0]."</td></tr></br>";
                }
                echo "</div>";
            }
        ?>
        <table>
            <img class="table-title" src="./img/livros.png" alt="livro" />
            <tr>
                <th>Capa</th>
                <th>Título</th>
            </tr>
            <?php
            $selectLivros= pg_query($connection, "SELECT titulo, imagem, id FROM livro");

            if (!$selectLivros) {
                echo "Erro na consulta.<br>";
                exit;
            }

            while ($livros = pg_fetch_row($selectLivros)) {
                echo "
                    <tr>
                        <td><img src='".$livros[1]."'></td>
                        <td>".$livros[0]."</td>
                        <td class='td-form'>
                            <form method='post' action='usuario.php' >
                                <input type='hidden' id='livroId' name='livroId' value='".$livros[2]."'>
                                <input type='hidden' name='local' value='usuario'>
                                <input type='submit' value='Alugar'>
                            </form>
                        </td>
                    </tr>
                </table>";
            }
        ?>
        <div class="container">
            <a href="redirect.php"><input class="button" type="button" value="Sair"></a>
        </div>
    </main>
</body>