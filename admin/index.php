<?php

session_start();

include '../includes/conexao.php';

include 'includes/verificar_admin.php';

/* PRODUTOS */

$sqlProdutos = $pdo->query(
"SELECT COUNT(*) as total FROM produtos"
);

$totalProdutos =
$sqlProdutos->fetch()['total'];

/* PEDIDOS */

$sqlPedidos = $pdo->query(
"SELECT COUNT(*) as total FROM pedidos"
);

$totalPedidos =
$sqlPedidos->fetch()['total'];

/* USUÁRIOS */

$sqlUsuarios = $pdo->query(
"SELECT COUNT(*) as total FROM usuarios"
);

$totalUsuarios =
$sqlUsuarios->fetch()['total'];

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin</title>

<link
rel="stylesheet"
href="css/admin.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<div class="admin-layout">

<?php include 'includes/sidebar.php'; ?>

<div class="conteudo">

<?php include 'includes/topbar.php'; ?>

    <div class="topo">

        <h1>Dashboard</h1>

        <p>
            Bem-vinda ao painel administrativo da InfoGirls.
        </p>

    </div>

    <div class="cards">

        <div class="card">

            <i class="fa-solid fa-box"></i>

            <h2>
                <?= $totalProdutos; ?>
            </h2>

            <p>Total de produtos</p>

        </div>

        <div class="card">

            <i class="fa-solid fa-cart-shopping"></i>

            <h2>
                <?= $totalPedidos; ?>
            </h2>

            <p>Total de pedidos</p>

        </div>

        <div class="card">

            <i class="fa-solid fa-users"></i>

            <h2>
                <?= $totalUsuarios; ?>
            </h2>

            <p>Total de usuários</p>

        </div>

    </div>

</div>

</div>

</body>
</html>
