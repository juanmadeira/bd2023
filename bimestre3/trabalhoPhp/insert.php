<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <link rel="stylesheet" href="./style.css">
        <title>adição de itens | segundo trabalho 3º bi | php</title>
    </head>
    <body>
        <?php
            error_reporting(0);
            $path = "host=localhost dbname=bd2023 user=postgres password=postgres";
            if(!$cc = pg_connect($path)) die ("erro ao conectar ao banco<br>");
        ?>
        <h1>adição de itens</h1>
        <div class="container">
            <form action="./insert.php" method="post">
                <label for="item">insira o item a ser adicionado: </label>
                <input type="text" name="item"><br>
                <label for="qtd">insira a sua quantidade no estoque: </label>
                <input type="text" name="qtd"><br>
                <label for="preco">insira o seu preço: R$</label>
                <input type="text" name="preco"><br>
                <a href="./index.php" class="button">📜</a>
                <button type="submit" name="adicionar" class="button">✔️</button>
                <?php
                    pg_query($cc, "INSERT INTO Itens (nome_item, qtd_item, preco_item) VALUES ('".$_POST['item']."',".$_POST['qtd'].",".$_POST['preco'].");");
                ?>
            </form>
        </div>
    </body>
</html