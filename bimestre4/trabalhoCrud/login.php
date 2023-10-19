<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
    <link rel="stylesheet" href="./style.css" />
    <title>the amazing digital library</title>
</head>
<body>
    <?php
        $path = "host=localhost dbname=trabalho41 user=postgres password=postgres";
        if(!$connection = pg_connect($path)) die ("Erro ao conectar ao banco<br>");
    ?>
    <form action="insert.php" method="post">
        <div class="container">
            <label for="usu">Email:</label>
            <input type="text" id="usu" name="usu"></input>
        </div>
        <div class="container">
            <label for="se">Senha:</label>
            <input type="text" id="se" name="se"></input>
        </div>
        <div class="container">
        <a href="index.html"><input type="button" value="LOGIN">
        </div>
        <div class="container">
            <a href="index.html"><input type="button" value="VOLTAR"></a>
        </div>
    </form>
</body>