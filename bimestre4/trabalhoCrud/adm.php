<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="./script/script.js" defer></script>
    <title>ADM | the amazing digital library</title>
</head>
<body>
    <main class="column-main">
        <div class="title-main">
            <img src="./img/book.gif" alt="gif de um livro" />
            <img src="./img/adm.png" alt="adm title" />
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

            if ($_SESSION['type'] != 'adm') {
                header("location: index.php");
            }
            $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
            if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

            //USUARIOS
            $result = pg_query($connection, "SELECT * FROM usuario");

            if(isset($_POST['deleteById']) != null) {
                pg_query($connection, "DELETE FROM usuario WHERE id =".$_POST['deleteById'].";");
                header("location: blank.php");
            }

            if(isset($_POST['deleteLivroId']) != null) {
                pg_query($connection, "DELETE FROM livro WHERE id =".$_POST['deleteLivroId'].";");
                header("location: blank.php");
            }

            if(isset($_POST['updatedId']) != null) {
                pg_query($connection, "UPDATE usuario SET nm = '".$_POST['nm']."', email= '".$_POST['mail']."' WHERE id = ".$_POST['updatedId'].";");
                header("location: blank.php");
            }

            if(isset($_POST['updatedLivroId']) != null) {
                pg_query($connection, "UPDATE livro SET autores = '".$_POST['autores']."', titulo = '".$_POST['titulo']."', imagem = '".$_POST['imagem']."', ano = '".$_POST['ano']."', editora = '".$_POST['editora']."', quantidade = '".$_POST['quantidade']."' WHERE id = ".$_POST['updatedLivroId'].";");
                header("location: blank.php");
            }

            //LIVROS
            if(isset($_FILES['coverUpload']) && $_POST['local'] == 'adm') {
                date_default_timezone_set("Brazil/East");

                $ext = strtolower(substr($_FILES['coverUpload']['name'],-4));
                $new_name = date("Y.m.d-H.i.s") . $ext;
                $dir = 'uploads/';

                move_uploaded_file($_FILES['coverUpload']['tmp_name'], $dir.$new_name);

                pg_query($connection, "INSERT INTO livro (autores, titulo, imagem, ano, editora, quantidade) VALUES ('".$_POST['autores']."','".$_POST['titulo']."','".$dir.$new_name."','".$_POST['ano']."','".$_POST['editora']."',".$_POST['qtd'].");");
                header("location: blank.php");
            }
        ?>
        <table>
            <img class="table-title" src="./img/usuarios.png" alt="usuários" />
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            <?php
                $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
                if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                $result = pg_query($connection, "SELECT id, nm, email FROM usuario WHERE isadm IS NULL");

                if (!$result) {
                    echo "Erro na consulta.<br>";
                    exit;
                }

                while ($row = pg_fetch_row($result)) {
                    echo "<tr>
                            <td>".$row[1]."</td>
                            <td>".$row[2]."</td>
                            <td class='td-form'>
                                <form method='post' action='adm.php'>
                                    <input type='hidden' id='deleteById' name='deleteById' value='".$row[0]."'>
                                    <input type='submit' value='Excluir'>
                                </form>
                            </td>
                            <td class='td-form'>
                                <form method='post' action='atualizarusuario.php' >
                                    <input type='hidden' id='updateById' name='updateById' value='".$row[0]."'>
                                    <input type='submit' value='Atualizar'>
                                </form>
                            </td>
                        </tr>";
                }
            ?>
        </table>
        <table>
            <img class="table-title" src="./img/livros.png" alt="livro" />
            <tr>
                <th>Capa</th>
                <th>Título</th>
            </tr>
            <?php
                $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
                if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

                $selectLivros= pg_query($connection, "SELECT titulo, imagem, id FROM livro");

                if (!$selectLivros) {
                    echo "Erro na consulta.<br>";
                    exit;
                }
            
                while ($livros = pg_fetch_row($selectLivros)) {
                    echo "<tr>
                            <td class='td-img'><img src='".$livros[1]."'></td>
                            <td>".$livros[0]."</td>
                            <td class='td-form'>
                                <form method='post' action='adm.php' >
                                    <input type='hidden' id='deleteLivroId' name='deleteLivroId' value='".$livros[2]."'>
                                    <input type='submit' value='Excluir'>
                                </form>
                            </td>
                            <td class='td-form'>
                                <form method='post' action='atualizarlivro.php' >
                                    <input type='hidden' id='livroId' name='livroId' value='".$livros[2]."'>
                                    <input type='submit' value='Atualizar'>
                                </form>
                            </td>
                        </tr>";
                }
            ?>
        </table>
        <div class="container">
            <img class="table-title" src="./img/cadastrar.png" alt="usuários"/>
        </div>
        <form action="adm.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <label for="autores">Autores:</label>
                <input type="text" id="autores" name="autores"></input>
            </div>

            <div class="container">
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo"></input>
            </div>

            <div class="container">
                <label for="coverUpload">Capa:</label>
                <input type="file" name="coverUpload"></input>
            </div>

            <div class="container">
                <label for="ano">Ano:</label>
                <input type="text" id="ano" name="ano"></input>
            </div>

            <div class="container">
                <label for="editora">Editora:</label>
                <input type="text" id="editora" name="editora"></input>
            </div>

            <div class="container">
                <label for="qtd">Volumes:</label>
                <input type="number" id="qtd" name="qtd"></input>
            </div>

            <div class="container">
                <input type="hidden" name="local" value="adm">
                <input class="button" type="submit" value="Cadastrar">
            </div>
        </form>
        <div class="container">
            <a href="index.php"><input class="button" type="button" value="Sair"></a>
        </div>
    </main>
</body>