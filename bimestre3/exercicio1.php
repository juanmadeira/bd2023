<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <title>exercício 1 - PHP</title>
        <style>
            /* cursor */
            * {
                cursor: url("https://ani.cursors-4u.net/games/gam-16/gam1561.cur"), auto;
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
                background-color: black;
                color: #00ffff;
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
        </style>
        <!--
        criar uma tabela em HTML e PHP, que crie um indice a partir do 0 até 20, com as seguintes colunas: 
        apresentar a potenciacao por 2
        apresentar o fatorial.
        exemplo:
        0   0   1
        1   1   1
        2   4   2
        3   9   6    
        -->
    </head>
    <body>
        <table>
            <tr>
                <th>número</th>
                <th>quadrado</th>
                <th>fatorial</th>      
            </tr>
            <?php
                $array = array(
                    0 => array(),
                    1 => array()
                );
                for ($i=1; $i <= 20; $i++) { 
                    $array[0][$i] = ($i**2);
                    $array[1][$i] = array_product(range($i, 1));
                    echo "<tr><td>".$i."</td><td>".$array[0][$i]."</td><td>".$array[1][$i]."</td></tr>";
                }    
            ?>
        </table>
    </body>
</html>
