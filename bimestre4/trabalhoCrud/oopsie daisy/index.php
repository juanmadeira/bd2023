<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>

    <style>
        body {
            background-color: black;
            color: crimson;
            font-family: sans-serif;
            
        }

        .container {
            display: flex;
            flex-flow: column wrap;
            align-items: center;
            align-content: center;
            margin-top:2.5%
        }

        label {
            font-size: 115%;
            font-weight: bold;
        }

        input[type="text"] {
            background-color: black;
            border: crimson solid 2pt;
            outline: none;
            border-radius: 3.5%;
            color: crimson;
        }

        input[type="submit"], input[type="button"] {
            background-color: crimson;
            border: solid crimson 1pt;
            border-radius: 50%;
            color: black;
            font-weight: bold;
            font-size: 70%;
            margin-top: 3%;
            width: 60pt;
            height: 60pt;
            padding:0.1%;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            animation: color 0.5s forwards;
        }
        @keyframes color{
            from{
                background-color: crimson;
                border: solid crimson 0.1pt;
            }
            to{
                background-color: rgb(247, 83, 116);
                border: solid rgb(247, 83, 116) 0.1pt;
            }
        }
    </style>
</head>


<body>
    <form action="redirect.php" method="post">
        <div class="container">
            <p>Registrar</p>
        </div>
        <div class="container">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"></input>
        </div>

        <div class="container">
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="mail"></input>
        </div>

        <div class="container">
            <label for="se">Senha:</label>
            <input type="password" id="se" name="se"></input>
        </div>

        <div class="container">
            <label for="cse">Confirmar Senha:</label>
            <input type="password" id="cse" name="cse"></input>
        </div>

        <div class="container">
            <input type="hidden" name="local" value="login">
            <input type="submit" value="REGISTRAR">
        </div>
    </form>

    <form action="redirect.php" method="post">
        <div class="container">
            <p>Login</p>
        </div>
        <div class="container">
            <label for="usu">Email:</label>
            <input type="email" id="usu" name="usu"></input>
        </div>

        <div class="container">
            <label for="sen">Senha:</label>
            <input type="password" id="sen" name="sen"></input>
        </div>

        <div class="container">
            <input type="submit" value="ENTRAR">
        </div>
    </form>
</body>