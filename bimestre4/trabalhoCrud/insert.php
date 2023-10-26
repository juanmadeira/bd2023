<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style.css" />
    <title>the amazing digital library</title>
</head>
<body>
    <main>
        <?php
            $path = "host=localhost dbname=trabalho32 user=postgres password=postgres";
            if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");

            pg_query($connection, "INSERT INTO itens (nm, qt, vl) VALUES ('".$_POST['nome']."',".$_POST['quan'].",".$_POST['pre'].");");
        ?>

        <form action="insert.php" method="post">
            <div class="container">
                <label for="nome">Nome do Item:</label>
                <input type="text" id="nome" name="nome"></input>
            </div>

            <div class="container">
                <label for="quan">Quantidade:</label>
                <input type="text" id="quan" name="quan"></input>
            </div>

            <div class="container">
                <label for="pre">Preço:</label>
                <input type="text" id="pre" name="pre"></input>
            </div>

            <div class="container">
                <input type="submit" value="INSERIR">
            </div>

            <div class="container">
                <a href="index.html"><input type="button" value="VOLTAR"></a>
            </div>
        </form>
    </main>
</body>