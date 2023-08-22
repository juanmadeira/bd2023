<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculadora em php</title>
</head>
<body>
<h1>calculadora em php</h1>
    <form method="POST" action="">
        <label for="num1">Número 1:</label>
        <input type="text" name="num1" required><br>
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
        </select><br>
        <button type="submit" name="calculate">Calcular</button>
    </form>
    <?php
        function factorial($n) {
            if ($n <= 1) {
                return 1;
            } else {
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
                    } else {
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

            echo "<p>Resultado: $result</p>";
        }
    ?>
</body>
</html>