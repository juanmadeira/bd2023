<head>
    <link rel="stylesheet" href="./style.css">
</head>

<?php
    $path = "host=localhost dbname=bd2023 user=postgres password=postgres";
    if(!$cc = pg_connect($path)) die ("erro ao conectar ao banco<br>");

    pg_query($cc, "INSERT INTO Item (nome_item, qtd_item, preco_item) VALUES ('".$_POST['item']."',".$_POST['qtd'].",".$_POST['preco'].");");
?>

<h1>adicionar itens</h1>
<div class="container">
    <form action="./insert.php" method="post">
        <label for="item">insira o item a ser adicionado: </label>
        <input type="text" name="item"><br>
        <label for="qtd">insira a sua quantidade no estoque: </label>
        <input type="text" name="qtd"><br>
        <label for="prec">insira o seu preço: R$</label>
        <input type="text" name="preco"><br>
        <button type="submit" name="adicionar" class="button">adicionar</button>
        <a href="./index.php" class="button">visualizar</a>
    </form>
</div>