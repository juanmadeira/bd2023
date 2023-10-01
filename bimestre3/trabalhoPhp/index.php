<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <link rel="stylesheet" href="./style.css">
        <title>listagem de itens | segundo trabalho 3º bi | php</title>
    </head>
    <body>
        <?php
            error_reporting(0);
            $path = "host=localhost dbname=bd2023 user=postgres password=postgres";
            if(!$cc = pg_connect($path)) die ("erro ao conectar ao banco<br>");
            
            pg_query($cc, "create table Itens (
                id_item serial primary key,
                nome_item varchar(50) not null,
                qtd_item int not null,
                preco_item numeric(10, 2) not null
            );");

            if (!empty($_POST['remover'])) {
                $remover = $_POST['remover'];
                pg_query($cc, "DELETE FROM Itens WHERE id_item = $remover");
            }
        ?>
        <h1 class="table">listagem de itens</h1>
        <div class="container">
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>item</th>
                    <th>quantidade</th>
                    <th>preço</th>
                    <th>remover</th>
                </tr>
                <?php
                    $result = pg_query($cc, "SELECT id_item, nome_item, qtd_item, preco_item FROM Itens");
                    while ($row = pg_fetch_row($result)) {
                        echo "
                        <tr>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>R$$row[3]</td>
                            <td>
                                <form action='./index.php' method='post'>
                                    <input type='hidden' id='inputHidden' name='remover' value='$row[0]'>
                                    <button type='submit' class='button'>❌</button>
                                </form>
                            </td>
                        </tr>";
                    }
                ?>
            </table>
            <form action="./index.php" method="post">
                <?php
                    pg_query($cc, "DROP TABLE ITENS");
                ?>
                <button type="submit" class="button">🧹</button>
                <a href="./insert.php" class="button">➕</a>
            </form>
        </div>
    </body>
</html>