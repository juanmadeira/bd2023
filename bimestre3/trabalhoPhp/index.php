<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <link rel="stylesheet" href="./style.css">
        <title>segundo trabalho - 3º bi | php</title>
    </head>
    <body>
        <?php
            $path = "host=localhost dbname=bd2023 user=postgres password=postgres";
            if(!$cc = pg_connect($path)) die ("erro ao conectar ao banco<br>");
        ?>

        <h1 class="table">listagem de itens</h1>
        <div class="container">
        <table class="table">
            <tr>
                <th>item</th>
                <th>quantidade</th>
                <th>preço</th>
            </tr>
            <?php
                $result = pg_query($cc, "SELECT nome_item, qtd_item, preco_item FROM Item");    
                if (!$result) {
                    echo "erro na consulta";
                    exit;
                }
                while ($row = pg_fetch_row($result)) {
                    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>R$$row[2]</td></tr>";
                }
                ?>
        </table>
            <a href="./insert.php" class="button">adicionar</a>
        </div>
    </body>
</html>