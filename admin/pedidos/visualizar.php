<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

if(!isset($_GET['id'])){
    header("Location: listar.php");
    exit;
}

$id = $_GET['id'];

/* PEDIDO */

$sql = $pdo->prepare("

SELECT *
FROM pedidos
WHERE id_pedidos = ?

");

$sql->execute([$id]);

$pedido = $sql->fetch(PDO::FETCH_ASSOC);

if(!$pedido){
    header("Location: listar.php");
    exit;
}

/* ITENS */

$itens = $pdo->prepare("

SELECT *
FROM itens_pedido
WHERE id_pedido = ?

");

$itens->execute([$id]);

$listaItens =
$itens->fetchAll(PDO::FETCH_ASSOC);

/* ALTERAR STATUS */

if(isset($_POST['status'])){

    $novoStatus = $_POST['status'];

    $update = $pdo->prepare("

    UPDATE pedidos
    SET status = ?
    WHERE id_pedidos = ?

    ");

    $update->execute([
        $novoStatus,
        $id
    ]);

    header("Location: visualizar.php?id=$id");
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

<title>Visualizar Pedido</title>

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

<h1>
Pedido #<?= $pedido['id_pedidos']; ?>
</h1>

<p>
Detalhes completos do pedido.
</p>

</div>

<div class="pedido-box">

<h2>Cliente</h2>

<p>
<strong>Nome:</strong>
<?= $pedido['cliente_nome']; ?>
</p>

<p>
<strong>Email:</strong>
<?= $pedido['cliente_email']; ?>
</p>

<p>
<strong>Total:</strong>

R$
<?= number_format(
$pedido['total'],
2,
',',
'.'
); ?>

</p>

</div>

<div class="pedido-box">

<h2>Produtos</h2>

<?php foreach($listaItens as $item): ?>

<div class="item-pedido">

<p>
<?= $item['nome_produto']; ?>
</p>

<p>
Qtd: <?= $item['quantidade']; ?>
</p>

</div>

<?php endforeach; ?>

</div>

<div class="pedido-box">

<h2>Status</h2>

<form method="POST">

<select
name="status"
class="select-status">

<option value="pendente">
Pendente
</option>

<option value="enviado">
Enviado
</option>

<option value="entregue">
Entregue
</option>

<option value="cancelado">
Cancelado
</option>

</select>

<button
class="btn-admin">

Salvar Status

</button>

</form>

</div>

</div>

</div>

</body>
</html>
