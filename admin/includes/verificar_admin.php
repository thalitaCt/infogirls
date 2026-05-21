<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../contas.php");
    exit;
}

if($_SESSION['tipo'] != 'admin'){
    header("Location: ../index.php");
    exit;
}
?>
