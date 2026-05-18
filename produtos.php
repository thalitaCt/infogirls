<?php
session_start();
include 'includes/conexao.php';

$sql = $pdo->query("
SELECT *
FROM produtos
ORDER BY id_produtos DESC
");

$produtos = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Produtos - Info Girls</title>

<link rel="stylesheet" href="css/styleProdutos.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<?php include 'includes/navbar.php'; ?>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'adicionado'): ?>

<div class="alerta sucesso">

<i class="fa-solid fa-circle-check"></i>

<span>
<?= htmlspecialchars($_GET['nome']) ?>
adicionado ao carrinho
</span>

<div class="fechar"
onclick="this.parentElement.style.display='none'">
<i class="fa-solid fa-xmark"></i>
</div>

</div>

<?php endif; ?>

<?php if(isset($_GET['erro'])): ?>

<div class="alerta erro">

<i class="fa-solid fa-triangle-exclamation"></i>

<span>

<?php

if($_GET['erro'] == 'limite_estoque'){
    echo "Quantidade máxima em estoque atingida.";
}

elseif($_GET['erro'] == 'estoque'){
    echo "Produto sem estoque.";
}

elseif($_GET['erro'] == 'produto'){
    echo "Produto não encontrado.";
}

?>

</span>

<div class="fechar"
onclick="this.parentElement.style.display='none'">
<i class="fa-solid fa-xmark"></i>
</div>

</div>

<?php endif; ?>

<section class="topo">

<h1>
Nossos Produtos
</h1>

<p>
Tecnologia, acessórios e estilo gamer em um só lugar.
</p>

</section>

<section class="produtos-container">

<div class="produtos">

<?php foreach($produtos as $p): ?>

<div class="produto-card
<?php if($p['estoque'] <= 0) echo 'sem-estoque'; ?>">

<div class="imagem-box">

<img src="<?= htmlspecialchars($p['imagem']) ?>">

<?php if($p['estoque'] <= 0): ?>

<span class="badge-esgotado">
Esgotado
</span>

<?php endif; ?>

</div>

<div class="produto-info">

<h3>
<?= htmlspecialchars($p['nome']) ?>
</h3>

<p class="descricao">
<?= htmlspecialchars($p['descricao']) ?>
</p>

<div class="produto-footer">

<div>

<span class="preco">

R$
<?= number_format($p['preco'],2,',','.') ?>

</span>

<p class="estoque">

<?php if($p['estoque'] > 0): ?>

<?= $p['estoque'] ?> disponíveis

<?php else: ?>

Sem estoque

<?php endif; ?>

</p>

</div>

</div>

<form action="actions/add.php"
method="POST">

<input type="hidden"
name="id"
value="<?= $p['id_produtos'] ?>">

<?php if($p['estoque'] > 0): ?>

<div class="acoes">

<button
type="submit"
name="acao"
value="comprar"
class="btn-comprar">

<i class="fa-solid fa-bolt"></i>

Comprar Agora

</button>

<button
type="submit"
name="acao"
value="adicionar"
class="btn-carrinho">

<i class="fa-solid fa-cart-shopping"></i>

Adicionar

</button>

</div>

<?php else: ?>

<button
class="btn-esgotado"
disabled>

Produto indisponível

</button>

<?php endif; ?>

</form>

</div>

</div>

<?php endforeach; ?>

</div>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
