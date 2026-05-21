<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

if(!isset($_GET['id'])){
    header("Location: listar.php");
    exit;
}

$id = $_GET['id'];

$sql = $pdo->prepare("

DELETE FROM contatos
WHERE id_contatos = ?

");

$sql->execute([$id]);

header("Location: listar.php");
exit;
