<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

$sql = $pdo->query("

SELECT *
FROM pedidos
ORDER BY id_pedidos DESC

");

$pedidos = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pedidos</title>

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

    <h1>Pedidos</h1>

    <p>
        Gerencie os pedidos da loja.
    </p>

</div>

<div class="tabela-container">

<table class="tabela">

<thead>

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Total</th>
<th>Status</th>
<th>Data</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($pedidos as $pedido): ?>

<tr>

<td>
#<?= $pedido['id_pedidos']; ?>
</td>

<td>
<?= $pedido['cliente_nome']; ?>
</td>

<td>

R$
<?= number_format(
$pedido['total'],
2,
',',
'.'
); ?>

</td>

<td>

<span class="status <?= $pedido['status']; ?>">

<?= ucfirst($pedido['status']); ?>

</span>

</td>

<td>

<?= date(
'd/m/Y',
strtotime($pedido['data_pedido'])
); ?>

</td>

<td class="acoes-tabela">

<a
href="visualizar.php?id=<?= $pedido['id_pedidos']; ?>"
class="editar">

<i class="fa-solid fa-eye"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>
