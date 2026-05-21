<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = $pdo->prepare("
    DELETE FROM produtos
    WHERE id_produtos = ?
    ");

    $sql->execute([$id]);

}

header("Location: listar.php");
exit;
