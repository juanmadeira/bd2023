<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Ferramenta</th>
                <th>Preço</th>
            </tr>
            <?php
                $dados = array (
                    "chave_de_fenda" => 6.00,
                    "parafuso" => 0.40,
                    "alicate" => 12.00,
                    "multimetro" => 31.50
                );
                foreach ($dados as $key => $value) {
                    echo "
                    <tr>
                        <td>$key</td>
                        <td> $value</td>
                    </tr>
                    ";
                }
            ?>
        </table>
    </body>
</html>