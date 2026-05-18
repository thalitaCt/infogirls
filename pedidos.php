<?php
session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: login.php?erro=login");
    exit;
}


include 'includes/conexao.php';
include 'includes/navbar.php';


$email = $_SESSION['usuario'];


$sql = $pdo->prepare("
SELECT *
FROM pedidos
WHERE cliente_email = ?
ORDER BY id_pedidos DESC
");


$sql->execute([$email]);


$pedidos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minhas Solicitações</title>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/stylePedidos.css">
</head>

<body>

<div class="container">

<h1 class="titulo">
Minhas Solicitações
</h1>


<p class="subtitulo">
Acompanhe seus pedidos, produtos e serviços solicitados.
</p>


<?php if(count($pedidos) > 0): ?>


<?php foreach($pedidos as $p): ?>


<?php


$codigo = 'IG-' . str_pad($p['id_pedidos'], 5, '0', STR_PAD_LEFT);


$status = strtolower($p['status']);


$classeStatus = 'status-pendente';


if($status == 'em análise'){
    $classeStatus = 'status-analise';
}
elseif($status == 'em andamento'){
    $classeStatus = 'status-andamento';
}
elseif($status == 'concluído'){
    $classeStatus = 'status-concluido';
}


?>


<div class="pedido">


<div class="pedido-header">


<div>


<h2>
<i class="fa-solid fa-layer-group"></i>
<?= $codigo ?>
</h2>


<p class="data">
<?= date('d/m/Y H:i', strtotime($p['data_pedido'])) ?>
</p>


</div>


<div class="badges">


<span class="badge <?= $p['pago'] ? 'pago' : 'pendente' ?>">
<i class="fa-solid fa-wallet"></i>


<?= $p['pago'] ? 'Pagamento confirmado' : 'Pagamento pendente' ?>
</span>


<span class="badge <?= $classeStatus ?>">
<i class="fa-solid fa-circle-info"></i>


<?= $p['status'] ?>
</span>


</div>


</div>


<div class="infos">


<div class="box">


<span>Total</span>


<h3>
R$ <?= number_format($p['total'],2,',','.') ?>
</h3>


</div>


<div class="box">


<span>Forma de pagamento</span>


<h3>
<?= ucfirst($p['forma_pagamento']) ?>
</h3>


</div>


<div class="box">


<span>Entrega</span>


<h3>
<?= $p['regiao'] ?? 'Digital' ?>
</h3>


</div>


<div class="box">


<span>Frete</span>


<h3>


<?= $p['frete'] > 0
? 'R$ ' . number_format($p['frete'],2,',','.')
: 'Grátis'
?>


</h3>


</div>


</div>


<div class="endereco">


<h4>
<i class="fa-solid fa-location-dot"></i>
Destino do Pedido
</h4>


<p>


<?= !empty($p['endereco_entrega'])
? $p['endereco_entrega']
: 'Serviço digital sem entrega física.' ?>


</p>


</div>


<div class="acoes">


<a href="confirmacao.php?pedido=<?= $p['id_pedidos'] ?>">
<button class="btn-roxo">


<i class="fa-solid fa-eye"></i>
Ver detalhes


</button>
</a>


<a href="index.php">
<button class="btn-claro">


<i class="fa-solid fa-house"></i>
Voltar ao início


</button>
</a>


</div>


</div>


<?php endforeach; ?>


<?php else: ?>


<div class="vazio">


<i class="fa-solid fa-box-open"></i>


<h2>
Nenhuma solicitação encontrada
</h2>


<p>
Quando você realizar um pedido ou solicitar um serviço,
ele aparecerá aqui.
</p>


<a href="index.php">


<button>
Explorar serviços
</button>


</a>


</div>


<?php endif; ?>


</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>