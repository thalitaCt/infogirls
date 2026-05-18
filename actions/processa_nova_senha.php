<?php
include '../includes/conexao.php';

$token = $_POST['token'] ?? null;
$senha = $_POST['senha'] ?? null;
$senha_confirmar = $_POST['senha_confirmar'] ?? null;


if (empty($token) || empty($senha)) {
    header("Location: ../contas.php?erro=token_invalido");
    exit;
}

if ($senha !== $senha_confirmar) {
    header("Location: ../nova_senha.php?token=$token&erro=senhas_diferentes");
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);


$sql = "SELECT * FROM usuarios WHERE token = :token";
$stmt = $pdo->prepare($sql);
$stmt->execute(['token' => $token]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: ../contas.php?erro=token_invalido");
    exit;
}


$sql = "UPDATE usuarios 
        SET senha = :senha, 
            token = NULL, 
            token_expira = NULL 
        WHERE token = :token";


$stmt = $pdo->prepare($sql);
$stmt->execute([
    'senha' => $senhaHash,
    'token' => $token
]);


header("Location: ../contas.php?msg=senha_alterada");
exit;
?>
