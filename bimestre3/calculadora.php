<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="https://jutipia.neocities.org/img/figure/icon.ico" type="image/icon type">
        <title>calculadora em php</title>
        <style>
            /* cursor */
            * {
                cursor: url(https://ani.cursors-4u.net/toons/too-12/too1130.cur), auto
            }

            /* cor ao selecionar texto */
            ::selection {
                text-shadow: 0 0 2px #00ff60;
                color:#00ff60;
            }
            
            ::-moz-selection {
                text-shadow: 0 0 2px #00ff60;
                color:#00ff60;
            }

            /* scrollbar */
            ::-webkit-scrollbar {
                width: 5px;
                height: 10px;
                background: #000000;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #00abab50;  
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #008b8b50;  
            }

            /* body */
            body {
                font-family: "VT-100", fixedsys, System, monospace;
                display: flex;
                flex-flow: column wrap;
                background-color: black;
                color: #00ffff;
                justify-content: space-around;
                line-height: 2em;
            }

            h1 {
                margin: 0 auto;
                margin-bottom: 20px;
            }

            form { 
                margin: 0 auto;
                min-width: 25%
            }

            select {
                border: 1px solid transparent;
                border-radius: 6px;
                padding: 5px;
            }

            label[for="operation"] {
                display: flex;
                flex-flow: column wrap;
            }
            
            button {
                border: 1px solid transparent;
                border-radius: 6px;
                padding: 5px;
            }

            .result {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>calculadora em php</h1>
        <form method="POST" action="">
            <label for="num1">Número 1:</label>
            <input type="text" name="num1" required>
            <label for="num2">Número 2:</label>
            <input type="text" name="num2" required><br>
            <label for="operation">Operação:</label>
            <select name="operation">
                <option value="add">Adição</option>
                <option value="subtract">Subtração</option>
                <option value="multiply">Multiplicação</option>
                <option value="divide">Divisão</option>
                <option value="factorial">Fatorial</option>
                <option value="power">Potenciação</option>
            </select>
            <button type="submit" name="calculate">Calcular</button>
        </form>
        <?php
            function factorial($n) {
                if ($n <= 1) {
                    return 1;
                }
                else {
                    return $n * factorial($n - 1);
                }
            }

            if (isset($_POST['calculate'])) {
                $num1 = floatval($_POST['num1']);
                $num2 = floatval($_POST['num2']);
                $operation = $_POST['operation'];

                switch ($operation) {
                    case 'add':
                        $result = $num1 + $num2;
                        break;
                    case 'subtract':
                        $result = $num1 - $num2;
                        break;
                    case 'multiply':
                        $result = $num1 * $num2;
                        break;
                    case 'divide':
                        if ($num2 != 0) {
                            $result = $num1 / $num2;
                        }
                        else {
                            $result = "Divisão por zero!";
                        }
                        break;
                    case 'factorial':
                        $result = factorial($num1);
                        break;
                    case 'power':
                        $result = pow($num1, $num2);
                        break;
                    default:
                        $result = "Operação inválida";
                }

                echo "<div class='result'><p>Resultado: $result</p></div>";
            }
        ?>
    </body>
</html>