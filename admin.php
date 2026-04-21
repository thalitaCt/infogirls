<?php
session_start();
include 'includes/conexao.php';


if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}


/* TOTAL CLIENTES */
$sqlClientes = $pdo->query("SELECT COUNT(*) AS total FROM clientes");
$totalClientes = $sqlClientes->fetch(PDO::FETCH_ASSOC)['total'];


/* TOTAL PEDIDOS */
$sqlPedidos = $pdo->query("SELECT COUNT(*) AS total FROM pedidos");
$totalPedidos = $sqlPedidos->fetch(PDO::FETCH_ASSOC)['total'];


/* TOTAL VENDIDO */
$sqlVendas = $pdo->query("SELECT COALESCE(SUM(total),0) AS total FROM pedidos");
$totalVendas = $sqlVendas->fetch(PDO::FETCH_ASSOC)['total'];


/* ULTIMOS CLIENTES */
$clientes = $pdo->query("
    SELECT nome, email
    FROM clientes
    ORDER BY id_clientes DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);


/* ULTIMOS PEDIDOS */
$pedidos = $pdo->query("
    SELECT id_pedidos, cliente_nome, total
    FROM pedidos
    ORDER BY id_pedidos DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin</title>
<link rel="stylesheet" href="css/style.css">
<style>
    :root {
        --roxoEscuro: #7c3aed;
        --roxoEscuro2: #6d28d9;
        --roxoEscuro3: #5b21b6;
        --roxoEscuro4: #4c1d95;
        --roxoEscuro5: #2e1065;
        --branco: #ffffff;
        --preto: #333333;
        --roxoClaro: #8b5cf6;
        --roxoClaro2: #a78bfa;
        --roxoClaro3: #c4b5fd;
        --amarelo: #fde047;
        --amarelo2: #facc15;
    }
    
body{
    margin:0;
    background:#f5f3ff;
}


.admin-container{
    max-width:1200px;
    margin:auto;
    padding:30px;
}


.titulo{
    color:#6d28d9;
    margin-bottom:25px;
}


.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}


.card{
    background:#fff;
    border-radius:14px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}


.card h3{
    margin:0 0 10px 0;
    color:#6d28d9;
}


.card p{
    font-size:28px;
    margin:0;
    font-weight:bold;
}


.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}


.box{
    background:#fff;
    padding:20px;
    border-radius:14px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}


.box h2{
    color:#6d28d9;
    margin-top:0;
}


.item{
    padding:10px 0;
    border-bottom:1px solid #eee;
}


@media(max-width:768px){
    .grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>
<body>


<div class="admin-container">


<h1 class="titulo">Painel Administrativo</h1>


<div class="cards">


<div class="card">
<h3>Clientes</h3>
<p><?= $totalClientes ?></p>
</div>


<div class="card">
<h3>Pedidos</h3>
<p><?= $totalPedidos ?></p>
</div>


<div class="card">
<h3>Total Vendido</h3>
<p>R$ <?= number_format($totalVendas,2,',','.') ?></p>
</div>


</div>


<div class="grid">


<div class="box">
<h2>Últimos Clientes</h2>


<?php foreach($clientes as $c): ?>
<div class="item">
<strong><?= $c['nome'] ?></strong><br>
<?= $c['email'] ?>
</div>
<?php endforeach; ?>


</div>


<div class="box">
<h2>Últimos Pedidos</h2>


<?php foreach($pedidos as $p): ?>
<div class="item">
Pedido #<?= $p['id_pedidos'] ?><br>
<?= $p['nome_cliente'] ?><br>
<strong>R$ <?= number_format($p['total'],2,',','.') ?></strong>
</div>
<?php endforeach; ?>


</div>


</div>


</div>


</body>
</html>


