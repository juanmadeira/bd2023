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
    </head>
    <body>
        <header>
            <a href="./index.php"><img src="./img/logo-1.png" alt="the amazing"/></a>
            <a href="./index.php"><img src="./img/logo-2.png" alt="digital library" /></a>
        </header>
        <main class="row-main">
            <form action="redirect.php" method="post">
                <div class="container">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" />
                </div>
                <div class="container">
                    <label for="mail">Email:</label>
                    <input type="email" id="mail" name="mail" />
                </div>
                <div class="container">
                    <label for="se">Senha:</label>
                    <input type="password" id="se" name="se" />
                </div>
                <div class="container">
                    <label for="cse">Confirmar Senha:</label>
                    <input type="password" id="cse" name="cse" />
                </div>
                <div class="container">
                    <input type="hidden" name="local" value="login" />
                    <input class="button" type="submit" value="Registrar-se" />
                </div>
            </form>
            <img src="./img/bookworm.png" id="bookworm-img" onclick="playSound()" alt="worm from bookworm" />
            <form action="redirect.php" method="post">
                <div class="container">
                    <label for="usu">Email:</label>
                    <input type="email" id="usu" name="usu" />
                </div>
                <div class="container">
                    <label for="sen">Senha:</label>
                    <input type="password" id="sen" name="sen" />
                </div>
                <div class="container">
                    <input class="button" type="submit" value="Entrar" />
                </div>
            </form>
        </main>
    </body>
</html>