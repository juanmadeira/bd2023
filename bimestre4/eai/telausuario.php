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