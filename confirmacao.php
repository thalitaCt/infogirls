<?php
session_start();
include 'includes/conexao.php';


if(!isset($_SESSION['usuario'])){
    header("Location: contas.php?erro=login");
    exit;
}


if(!isset($_GET['pedido'])){
    header("Location: pedidos.php");
    exit;
}


$pedidoId = intval($_GET['pedido']);


/* BUSCAR PEDIDO */
$sql = $pdo->prepare("
SELECT *
FROM pedidos
WHERE id_pedidos = ?
AND cliente_email = ?
");


$sql->execute([
    $pedidoId,
    $_SESSION['usuario']
]);


$pedido = $sql->fetch(PDO::FETCH_ASSOC);


if(!$pedido){
    header("Location: pedidos.php");
    exit;
}


/* ITENS */
$itens = $pdo->prepare("
SELECT *
FROM itens_pedido
WHERE pedido_id = ?
");


$itens->execute([$pedidoId]);


$listaItens = $itens->fetchAll(PDO::FETCH_ASSOC);


/* STATUS */
$statusPagamento = $pedido['pago']
? 'Pagamento Confirmado'
: 'Aguardando Pagamento';


$iconePagamento = $pedido['pago']
? 'fa-circle-check'
: 'fa-clock';


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Pedido Confirmado</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


:root{
        --roxoEscuro:#8b77c6;
        --roxoEscuro2:#7660b3;
        --roxoEscuro3:#584194;
        --roxoEscuro4:#4a347f;
        --roxoEscuro5:#2d1d52;


        --roxoClaro:#8b5cf6;
        --roxoClaro2:#a78bfa;
        --roxoClaro3:#c4b5fd;


        --amarelo:#fde047;
        --amarelo2:#facc15;


        --branco:#ffffff;
        --preto:#333333;
    }


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Poppins;
}


body{
    background:linear-gradient(
    135deg,
    var(--roxoEscuro5),
    var(--roxoEscuro3)
    );


    min-height:100vh;
    padding:30px 15px;
    color:var(--branco);
}


.container{
    max-width:1200px;
    margin:auto;
}


/* TOPO */


.hero{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);


    backdrop-filter:blur(10px);


    padding:40px;
    border-radius:25px;


    text-align:center;


    margin-bottom:30px;
}


.hero-icon{
    width:100px;
    height:100px;


    margin:auto;
    margin-bottom:20px;


    border-radius:50%;


    background:rgba(253,224,71,0.15);


    display:flex;
    align-items:center;
    justify-content:center;


    color:var(--amarelo);


    font-size:45px;
}


.hero h1{
    font-size:38px;
    margin-bottom:10px;
}


.hero p{
    color:var(--roxoClaro3);
    font-size:16px;
}


/* GRID */


.grid{
    display:grid;
    grid-template-columns:1.5fr 1fr;
    gap:25px;
}


/* CARDS */


.card{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.12);


    backdrop-filter:blur(10px);


    border-radius:22px;
    padding:28px;


    margin-bottom:25px;
}


.card h2{
    margin-bottom:22px;
    font-size:26px;


    color:var(--amarelo);
}


/* INFO */


.info{
    display:flex;
    justify-content:space-between;
    align-items:center;


    padding:16px 0;


    border-bottom:1px solid rgba(255,255,255,0.1);
}


.info:last-child{
    border:none;
}


.label{
    color:var(--roxoClaro3);
    font-size:14px;
}


.valor{
    font-weight:600;
    text-align:right;
}


.status{
    display:flex;
    align-items:center;
    gap:10px;


    color:var(--amarelo);
    font-weight:600;
}


/* PRODUTOS */


.produto{
    display:flex;
    justify-content:space-between;
    gap:20px;


    padding:18px 0;


    border-bottom:1px solid rgba(255,255,255,0.1);
}


.produto:last-child{
    border:none;
}


.produto h3{
    margin-bottom:5px;
}


.produto p{
    color:var(--roxoClaro3);
    font-size:14px;
}


.preco{
    color:var(--amarelo);
    font-weight:700;
    white-space:nowrap;
}


/* TIMELINE */


.timeline{
    display:flex;
    flex-direction:column;
    gap:25px;
}


.etapa{
    display:flex;
    gap:15px;
}


.numero{
    min-width:42px;
    height:42px;


    border-radius:50%;


    background:var(--amarelo);
    color:var(--roxoEscuro5);


    font-weight:700;


    display:flex;
    align-items:center;
    justify-content:center;
}


.etapa h4{
    margin-bottom:5px;
}


.etapa p{
    color:var(--roxoClaro3);
    font-size:14px;
}


/* TOTAL */


.total{
    font-size:28px;
    color:var(--amarelo);


    font-weight:700;
}


/* BOTÕES */


.botoes{
    display:flex;
    gap:18px;
    flex-wrap:wrap;


    margin-top:10px;
}


.btn{
    flex:1;
    min-width:240px;


    text-decoration:none;


    padding:16px;
    border-radius:14px;


    text-align:center;


    font-weight:700;


    transition:0.3s;
}


.btn-roxo{
    background:var(--roxoClaro);
    color:var(--branco);
}


.btn-roxo:hover{
    transform:scale(1.03);
    background:var(--roxoClaro2);
    color:var(--roxoEscuro5);
}


.btn-amarelo{
    background:var(--amarelo);
    color:var(--roxoEscuro5);
}


.btn-amarelo:hover{
    transform:scale(1.03);
    background:var(--amarelo2);
}


/* RESPONSIVO */


@media(max-width:900px){


    .grid{
        grid-template-columns:1fr;
    }


}


@media(max-width:600px){


    .hero{
        padding:25px;
    }


    .hero h1{
        font-size:28px;
    }


    .card{
        padding:20px;
    }


    .produto{
        flex-direction:column;
    }


    .botoes{
        flex-direction:column;
    }


}


</style>
</head>


<body>


<div class="container">


<!-- TOPO -->


<div class="hero">


<div class="hero-icon">
<i class="fa-solid fa-circle-check"></i>
</div>


<h1>Pedido Realizado com Sucesso!</h1>


<p>
Seu pedido foi enviado para a InfoGirls e já está sendo processado.
</p>


</div>


<div class="grid">


<!-- ESQUERDA -->


<div>


<div class="card">


<h2>Detalhes do Pedido</h2>


<div class="info">


<div>
<p class="label">Pedido</p>


<p class="valor">
INF-<?= str_pad($pedido['id_pedidos'], 5, '0', STR_PAD_LEFT); ?>
</p>
</div>


<div>
<p class="label">Data</p>


<p class="valor">
<?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?>
</p>
</div>


</div>


<div class="info">


<div>
<p class="label">Pagamento</p>


<p class="valor">
<?= strtoupper($pedido['forma_pagamento']) ?>
</p>
</div>


<div>
<p class="label">Status</p>


<p class="status">
<i class="fa-solid <?= $iconePagamento ?>"></i>
<?= $statusPagamento ?>
</p>
</div>


</div>


<div class="info">


<div>
<p class="label">Entrega</p>


<p class="valor">
<?= $pedido['regiao'] ?>
</p>
</div>


<div>
<p class="label">Status do Pedido</p>


<p class="valor">
<?= $pedido['status'] ?>
</p>
</div>


</div>


</div>


<!-- PRODUTOS -->


<div class="card">


<h2>Produtos Comprados</h2>


<?php foreach($listaItens as $item): ?>


<div class="produto">


<div>


<h3>
<?= htmlspecialchars($item['nome']) ?>
</h3>


<p>
Quantidade:
<?= $item['quantidade'] ?>
</p>


</div>


<div class="preco">


R$
<?= number_format(
$item['preco'] * $item['quantidade'],
2,
',',
'.'
); ?>


</div>


</div>


<?php endforeach; ?>


</div>


</div>


<!-- DIREITA -->


<div>


<!-- STATUS -->


<div class="card">


<h2>Acompanhamento</h2>


<div class="timeline">


<div class="etapa">


<div class="numero">1</div>


<div>


<h4>Pedido Recebido</h4>


<p>
Seu pedido foi registrado com sucesso no sistema.
</p>


</div>


</div>


<div class="etapa">


<div class="numero">2</div>


<div>


<h4>Separando Produtos</h4>


<p>
Nossa equipe está organizando os itens do pedido.
</p>


</div>


</div>


<div class="etapa">


<div class="numero">3</div>


<div>


<h4>Preparando Envio</h4>


<p>
Os produtos serão enviados para transporte em breve.
</p>


</div>


</div>


<div class="etapa">


<div class="numero">4</div>


<div>


<h4>Entrega</h4>


<p>
Seu pedido chegará no endereço informado.
</p>


</div>


</div>


</div>


</div>


<!-- RESUMO -->


<div class="card">


<h2>Resumo Financeiro</h2>


<div class="info">


<p class="label">
Total do Pedido
</p>


<p class="valor total">


R$
<?= number_format(
$pedido['total'],
2,
',',
'.'
); ?>


</p>


</div>


<div class="info">


<p class="label">
Frete
</p>


<p class="valor">


R$
<?= number_format(
$pedido['frete'],
2,
',',
'.'
); ?>


</p>


</div>


<div class="info">


<p class="label">
Entrega
</p>


<p class="valor">


<?= htmlspecialchars($pedido['endereco_entrega']) ?>


</p>


</div>


</div>


</div>


</div>


<div class="botoes">


<a href="produtos.php"
class="btn btn-roxo">


<i class="fa-solid fa-cart-shopping"></i>
Continuar Comprando


</a>


<a href="pedidos.php"
class="btn btn-amarelo">


<i class="fa-solid fa-box"></i>
Ver Meus Pedidos


</a>


</div>


</div>


</body>
</html>