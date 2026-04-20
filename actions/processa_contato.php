<?php
include '../includes/conexao.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$assunto = $_POST['assunto'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

if(empty($nome) || empty($email) || empty($assunto) || empty($mensagem)){
    header("Location: ../contato.php?erro=campos_vazios");
    exit;
}

try {

    $sql = $pdo->prepare("
        INSERT INTO contatos (nome, email, assunto, mensagem)
        VALUES (?, ?, ?, ?)
    ");

    $sql->execute([$nome, $email, $assunto, $mensagem]);

    header("Location: ../contato.php?msg=enviado");
    exit;

} catch (PDOException $e) {

    header("Location: ../contato.php?erro=geral");
    exit;
}
?>
