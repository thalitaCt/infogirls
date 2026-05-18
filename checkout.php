<?php
session_start();


if(empty($_SESSION['carrinho'])){
    header("Location: carrinho.php");
    exit;
}


include 'includes/navbar.php';


$total = 0;


foreach($_SESSION['carrinho'] as $item){
    $total += $item['preco'] * $item['quantidade'];
}


$frete = $_SESSION['frete'] ?? 0;


$totalFinal = $total + $frete;


$endereco = $_SESSION['endereco_pedido'] ?? null;


if(!$endereco){
    header("Location: frete.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>
<link rel="stylesheet" href="css/styleCheckout.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include 'includes/navbar.php'; ?>


<div class="checkout-container">


<div class="topo">
    <h1>Finalizar Compra</h1>
    <p>Revise seus produtos e escolha a forma de pagamento.</p>
</div>


<div class="steps">


    <div class="step concluido">
        <i class="fa-solid fa-location-dot"></i>
        <span>Endereço</span>
    </div>


    <div class="linha ativa"></div>


    <div class="step ativo">
        <i class="fa-solid fa-credit-card"></i>
        <span>Pagamento</span>
    </div>


</div>


<div class="checkout-grid">


<!-- PAGAMENTO -->


<div class="checkout-main">


<h2>Pagamento</h2>


<form action="actions/finalizar.php" method="POST">


<div class="metodos">


<label class="metodo ativo" id="pix-card">


<input
type="radio"
name="forma_pagamento"
value="pix"
checked
hidden>


<i class="fa-brands fa-pix"></i>


<h3>PIX</h3>


<p>Pagamento instantâneo com confirmação automática.</p>


</label>


<label class="metodo" id="cartao-card">


<input
type="radio"
name="forma_pagamento"
value="cartao"
hidden>


<i class="fa-solid fa-credit-card"></i>


<h3>Cartão</h3>


<p>Crédito e débito em até 3x sem juros.</p>


</label>


<label class="metodo" id="transferencia-card">


<input
type="radio"
name="forma_pagamento"
value="transferencia"
hidden>


<i class="fa-solid fa-building-columns"></i>


<h3>Transferência</h3>


<p>Pagamento via transferência bancária.</p>


</label>


</div>


<!-- PIX -->


<div id="pix-box">


<div class="pix-box">


<div class="qr-area">
<i class="fa-solid fa-qrcode"></i>
</div>


<p>Escaneie o QR Code usando o aplicativo do seu banco.</p>


<div class="chave-pix">
<strong>Chave PIX:</strong><br>
financeiro@infogirls.com
</div>


</div>


</div>


<!-- CARTÃO -->


<div class="hidden" id="cartao-box">


<div class="form-grid">


<div class="input-box full">
<label>Número do cartão</label>


<input
type="text"
placeholder="0000 0000 0000 0000">
</div>


<div class="input-box">
<label>Nome impresso</label>


<input
type="text"
placeholder="Nome do cartão">
</div>


<div class="input-box">
<label>CVV</label>


<input
type="text"
placeholder="123">
</div>


<div class="input-box">
<label>Validade</label>


<input
type="text"
placeholder="MM/AA">
</div>


<div class="input-box">
<label>Parcelamento</label>


<select>
<option>1x sem juros</option>
<option>2x sem juros</option>
<option>3x sem juros</option>
</select>
</div>


</div>


</div>


<!-- TRANSFERÊNCIA -->


<div class="hidden" id="transferencia-box">


<div class="transferencia">


<i class="fa-solid fa-building-columns"></i>


<p>


Banco InfoGirls<br><br>


Agência: 0001<br>
Conta: 12345-6<br>
PIX/CNPJ: 12.345.678/0001-99


</p>


</div>


</div>


<button type="submit" class="btn-finalizar">
Confirmar Compra
</button>


</form>


</div>


<!-- RESUMO -->


<aside class="resumo">


<h2>Resumo da Compra</h2>


<div class="resumo-linha">
<span>Produtos</span>
<span>R$ <?= number_format($total,2,',','.'); ?></span>
</div>


<div class="resumo-linha">
<span>Entrega</span>
<span>R$ <?= number_format($frete,2,',','.'); ?></span>
</div>


<div class="resumo-total">
<span>Total</span>
<span>R$ <?= number_format($totalFinal,2,',','.'); ?></span>
</div>


<div class="endereco">


<h3>
<i class="fa-solid fa-location-dot"></i>
Entrega
</h3>


<p>
<?= $endereco['endereco']; ?>,
<?= $endereco['numero']; ?>
</p>


<p>
<?= $endereco['bairro']; ?>
</p>


<p>
<?= $endereco['cidade']; ?> /
<?= $endereco['estado']; ?>
</p>


<p>
CEP:
<?= $endereco['cep']; ?>
</p>


</div>


</aside>


</div>


</div>


<?php include 'includes/footer.php'; ?>


<script>


const radios = document.querySelectorAll('input[name="forma_pagamento"]');


const pixBox = document.getElementById('pix-box');
const cartaoBox = document.getElementById('cartao-box');
const transferenciaBox = document.getElementById('transferencia-box');


const pixCard = document.getElementById('pix-card');
const cartaoCard = document.getElementById('cartao-card');
const transferenciaCard = document.getElementById('transferencia-card');


radios.forEach(radio => {


radio.addEventListener('change', () => {


    pixBox.classList.add('hidden');
    cartaoBox.classList.add('hidden');
    transferenciaBox.classList.add('hidden');


    pixCard.classList.remove('ativo');
    cartaoCard.classList.remove('ativo');
    transferenciaCard.classList.remove('ativo');


    if(radio.value === 'pix'){
        pixBox.classList.remove('hidden');
        pixCard.classList.add('ativo');
    }


    if(radio.value === 'cartao'){
        cartaoBox.classList.remove('hidden');
        cartaoCard.classList.add('ativo');
    }


    if(radio.value === 'transferencia'){
        transferenciaBox.classList.remove('hidden');
        transferenciaCard.classList.add('ativo');
    }


});


});


</script>


</body>
</html>