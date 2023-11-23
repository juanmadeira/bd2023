<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1347/1347631.png" />
        <link rel="stylesheet" href="./style/style.css" />
        <script src="./script/script.js" defer></script>
        <title>the amazing digital library</title>
        <!-- https://colorhunt.co/palette/2b3499ff6c22ff9209ffd099 -->
    </head>
    <body>
        <header>
            <a href="./index.html"><img src="./img/logo-1.png" alt="the amazing"/></a>
            <a href="./index.html"><img src="./img/logo-2.png" alt="digital library" /></a>
        </header>
        <main>
            <div class="form">
                <form action="login.php" method="post">
                    <input class="button" type="submit" value="Login">
                </form>
                <img src="./img/bookworm.png" id="bookworm-img" onclick="playSound()" alt="worm from bookworm">
                <form action="registrar.php" method="post">
                    <input class="button" type="submit" value="Registre-se">
                </form>
            </div>
        </main>
    </body>
</html>