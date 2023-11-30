<?php
    session_cache_expire(30);
    $cache_expire = session_cache_expire();
    
    session_start();

    switch ($_SESSION['type']) {

        case 'user':
            header("location: telausuario.php");
            break;

        case 'adm':
            header("location: telaadm.php");
            break;

        default:
            header("location: index.php");
            break;
    }
?>