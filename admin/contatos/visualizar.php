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

SELECT *
FROM contatos
WHERE id_contatos = ?

");

$sql->execute([$id]);

$msg = $sql->fetch(PDO::FETCH_ASSOC);

if(!$msg){
    header("Location: listar.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Mensagem</title>

<link
rel="stylesheet"
href="../css/admin.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<div class="admin-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="conteudo">

<div class="topo">

<h1>Mensagem</h1>

<p>
Visualização completa da mensagem.
</p>

</div>

<div class="pedido-box">

<h2>
<?= $msg['assunto']; ?>
</h2>

<p>

<strong>Nome:</strong>
<?= $msg['nome']; ?>

</p>

<p>

<strong>Email:</strong>
<?= $msg['email']; ?>

</p>

<p>

<strong>Data:</strong>

<?= date(
'd/m/Y',
strtotime($msg['data_envio'])
); ?>

</p>

</div>

<div class="pedido-box">

<h2>Mensagem</h2>

<div class="mensagem-texto">

<?= nl2br($msg['mensagem']); ?>

</div>

</div>

</div>

</div>

</body>
</html>
