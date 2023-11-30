<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="./script/script.js" defer></script>
    <title>atualizar livro | the amazing digital library</title>
</head>
<body>
    <main class="column-main">
        <div>
            <img src="./img/book.gif" alt="gif de um livro" />
            <img src="./img/adm.png" alt="adm title" />
        </div>
        <?php
            $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
            if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

            session_cache_expire(30);
            $cache_expire = session_cache_expire();

            session_start();

                echo "<div class='info'>";
                echo "Logado como <br>";
                echo "Nome: " . $_SESSION['usernm'] . '<br>';
                echo "Email: " . $_SESSION['usermail'];
                echo "</div>";

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
                <input class='button' type='submit' value='Atualizar'>
            </div>

            <input type='hidden' id='updatedLivroId' name='updatedLivroId' value='".$row[0]."'>
        </form>";
        ?>
    </main>
</body>