<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="./script/script.js" defer></script>
    <title>atualizar usuário | the amazing digital library</title>
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

            $result = pg_query($connection, "SELECT id, nm, email FROM usuario WHERE id=".$_POST['updateById'].";");

            if (!$result) {
                echo "Erro na consulta.<br>";
                exit;
            }

            $row = pg_fetch_row($result);

            echo "<form action='adm.php' method='post'>
            <div class='container'>
                <label for='nome'>Nome:</label>
                <input type='text' id='nm' name='nm' value='".$row[1]."'></input>
            </div>

            <div class='container'>
                <label for='email'>Email:</label>
                <input type='text' id='mail' name='mail' value='".$row[2]."'></input>
            </div>

            <div class='container'>
                <input class='button' type='submit' value='Atualizar'>
            </div>

            <input type='hidden' id='updatedId' name='updatedId' value='".$row[0]."'>
            </form>";
        ?>
    </main>
</body>