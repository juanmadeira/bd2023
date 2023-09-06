<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <title>segundo trabalho - 3º bi | php</title>
        <style>
            /* variaveis do css */
            :root {
                --body-bg-image: url('https://jutipia.neocities.org/img/figure/starsagain.gif');
                
                /* cores */
                --content-main: #00ffff;
                --content-main-hover: #00c0c0;
                --a: #e0ffff;
                --a-hover: #003030;
                --inner-background: #1a1a1a90;
                --border: #e1910566;
            }
            
            /* cursor */
            * {
                cursor: url(https://cur.cursors-4u.net/anime/ani-6/ani549.cur), auto
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
                background-image: var(--body-bg-image);
                background-color: black;
                display: flex;
                flex-flow: column wrap;
                text-align: center;
                color: var(--content-main);
            }

            form {
                text-align: center;
                margin: 0 auto;
                padding: 10px;
                border: solid 2px var(--border);
                column-gap: 200px;
                min-width: 25%;
            }

            button {

            }

            .table {
                display: none;
            }

            table {
                text-align: center;
                margin: 0 auto;
                padding: 10px;
                border: solid 2px var(--border);
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
                background: var(--inner-background);
            }
        </style>
        <script>
            /* querySelector const */
            const qs = (val) => {
                return document.querySelector(val);
            }

            function changeDisplay() {
                qs('table.table').style.display = "block";
                qs('h1.table').style.display = "block";
            }
        </script>
        <!--
            create table Item (
                id_item serial primary key,
                nome_item varchar(50) not null,
                qtd_item int not null,
                preco_item numeric(10, 2) not null
            );

            insert into Item (nome_item, qtd_item, preco_item) values
            ('Contrabaixo Strinberg Precision', '2', '1299.99'),
            ('Guitarra Epiphone SG', '4', '6499.99'),
            ('Guitarra Fender Jazzmaster', '7', '7499.99'),
            ('Guitarra Tagima MG30 Stratocaster', '16', '769.99');
        -->
    </head>
    <body>
        <?php
            $bdcon = pg_connect("host=localhost dbname=bd2023 user=postgres password=postgres");
            $con_string = "host=localhost dbname=bd2023 user=postgres password=postgres";
            if(!$dbcon = pg_connect($con_string)) die ("erro ao conectar ao banco".pg_last_error($dbcon));
        ?>
        <h1>formulário</h1>
        <form method="POST" action="">
            <label for="item">insira o item a ser adicionado: </label>
            <input type="text" name="item" required><br>
            <label for="qtd">insira a sua quantidade no estoque: </label>
            <input type="text" name="qtd" required><br>
            <label for="prec">insira o seu preço: R$</label>
            <input type="text" name="prec" required><br>
            <button type="submit" name="calculate" onclick="changeDisplay();">adicionar</button>
        </form>
        <h1 class="table">listagem de itens</h1>
        <table class="table">
            <tr>
                <th>item</th>
                <th>quantidade</th>
                <th>preço</th>
            </tr>
            <?php
                $result = pg_query($dbcon, "SELECT nome_item, qtd_item, preco_item FROM Item");    
                if (!$result) {
                    echo "erro na consulta";
                    exit;
                }
                while ($row = pg_fetch_row($result)) {
                    echo "<tr><td> $row[0] </td><td> $row[1] </td><td> $row[2] </td></tr>";
                }
            ?>
        </table>
        <?php
            pg_close($dbcon);
        ?>
    </body>
</html>