<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exercício 2 - php</title>
    <style>
        /* cursor */
        * {
            cursor: url(https://cur.cursors-4u.net/anime/ani-1/ani47.cur), auto
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

        table {
            text-align: center;
            margin: 0 auto;
            padding: 10px;
            border: solid 2px #e1910566;
            column-gap: 200px;
            min-width: 25%;
        }

        table th {
            padding: 0 25px;
        }

        table td {
            margin: 0;
            padding: 4px;
        }

        table tr:first-child {
            text-decoration: none;
            color: #e0ffff;
        }

        table tr:nth-child(odd) {
            background: #1a1a1a90;
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
        display: none;

        input {
            width: 100px;
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
    <h1>calculadora de salário líquido</h1>

    <table>
        <tr>
            <th>base de cálculo mensal (R$)	</th>
            <th>alíquota (%)</th>
        </tr>
        <tr>
            <td>até 1.903,98</td>
            <td>isento</td>
        </tr>
        <tr>
            <td>de 1.903,98 até 2.826,65</td>
            <td>7,5</td>
        </tr>
        <tr>
            <td>de 2.826,65 até 3.751,06</td>
            <td>15</td>
        </tr>
        <tr>
            <td>de 3.751,06 até 4.664,68</td>
            <td>22,5</td>
        </tr>
        <tr>
            <td>acima de 4.664,68</td>
            <td>27,5</td>
        </tr>
    </table><br>
    <form method="POST" action="">
        <label for="num">salário bruto: R$</label>
        <input type="text" name="num" required><br>

        <button type="submit" name="calculate">Calcular</button>
    </form>
        <?php
            if (isset($_POST['calculate'])) {
                $num = floatval($_POST['num']);
                $inss = $num * (11/100);
            }

            echo "<div class='result'><p>INSS: R$$inss</p></div>";
        ?>
</body>
</html>
