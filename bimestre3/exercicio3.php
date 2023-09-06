<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://jutipia.neocities.org/img/figure/icon.ico">
        <title>exercício 3 | poo - pg_connect, pgquery, etc</title>
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
                cursor: url(https://cur.cursors-4u.net/anime/ani-12/ani1136.ani), url(https://cur.cursors-4u.net/anime/ani-12/ani1136.gif), auto;
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
        <!--
            create table Artista (
                id_artista serial primary key,
                nome_artista varchar(50) not null,
                nome_album varchar(100) not null
            );

            insert into Artista (nome_artista, nome_album) values
            ('El Toro Fuerte', 'Um Tempo Lindo Para Estar Vivo'),
            ('Legião Urbana', 'O Descobrimento do Brasil'),
            ('Lupe de Lupe', 'Um Tijolo Com Seu Nome'),
            ('Radiohead', 'Kid A');
        -->
    </head>
    <body>
        <?php
            // conecta a um banco de dados chamado "semaninha"
            print "<h2>conectar ao banco no postgresql</h2>";
            $bdcon = pg_connect("dbname=semaninha");
            
            // coneta a um banco de dados chamado "semaninha" na máquina "localhost" com um usuário e senha
            $con_string = "host=localhost dbname=semaninha user=postgres password=postgres";
            if(!$dbcon = pg_connect($con_string)) die ("erro ao conectar ao banco".pg_last_error($dbcon));
        ?>
        <table>
            <tr>
                <th>id</th>
                <th>artista</th>
                <th>álbum</th>
            </tr>
            <?php
                // exemplo de execução da query e busca: 
                print "<h2>executar consulta (sql)</h2>";
                $result = pg_query($dbcon, "SELECT id_artista, nome_artista, nome_album FROM Artista");    
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
            // exemplo de fim de programa/conexão: 
            print "<h2>fechar conexão com o banco</H2>";
            pg_close($dbcon);
        ?>
    </body>
</html>