<?php 
session_start();
include 'includes/conexao.php';

if(!isset($_SESSION['usuario'])){
    header("Location: contas.php?erro=login_carrinho");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

/* =========================
   ATUALIZAR QTD
========================= */
if(isset($_POST['atualizarQtd'])){

    $id = $_POST['id'];
    $novaQtd = (int) $_POST['quantidade'];

    if(isset($_SESSION['carrinho'][$id])){

        $estoque = $_SESSION['carrinho'][$id]['estoque'];

        if($novaQtd <= 0){
            unset($_SESSION['carrinho'][$id]);
        } else {
            if($novaQtd > $estoque){
                $novaQtd = $estoque;
            }

            $_SESSION['carrinho'][$id]['quantidade'] = $novaQtd;
        }
    }

    header("Location: carrinho.php");
    exit;
}

/* =========================
   AUMENTAR
========================= */
if (isset($_GET['aumentar'])) {

    $id = $_GET['aumentar'];

    $sql = $pdo->prepare("SELECT estoque FROM produtos WHERE id_produtos = ?");
    $sql->execute([$id]);
    $produtoBD = $sql->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION['carrinho'][$id])) {

        $qtdAtual = $_SESSION['carrinho'][$id]['quantidade'];
        $estoque = $produtoBD['estoque'] ?? 0;

        if ($qtdAtual < $estoque) {
            $_SESSION['carrinho'][$id]['quantidade']++;
        }
    }

    header("Location: carrinho.php");
    exit;
}

/* =========================
   DIMINUIR
========================= */
if(isset($_GET['remover'])) {

    $id = $_GET['remover'];

    if(isset($_SESSION['carrinho'][$id])) {
        if ($_SESSION['carrinho'][$id]['quantidade'] > 1) {
            $_SESSION['carrinho'][$id]['quantidade']--;
        } else {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    header("Location: carrinho.php");
    exit;
}

/* =========================
   REMOVER ITEM
========================= */
if (isset($_GET['removerTudo'])) {

    $id = $_GET['removerTudo'];
    unset($_SESSION['carrinho'][$id]);

    header("Location: carrinho.php");
    exit;
}

/* =========================
   LIMPAR CARRINHO
========================= */
if(isset($_GET['limpar'])) {
    $_SESSION['carrinho'] = [];
    header("Location: carrinho.php");
    exit;
}

$carrinho = $_SESSION['carrinho'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Carrinho - InfoGirls</title>

<link rel="stylesheet" href="css/styleCarrinho.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

<h1>Seu Carrinho</h1>

<?php if(empty($carrinho)): ?>

<p style="text-align:center;opacity:0.7">Seu carrinho está vazio</p>

<?php else: ?>

<div class="layout">

<div class="lista">

<?php foreach ($carrinho as $id => $produto): ?>

<?php
if (!isset($_SESSION['carrinho'][$id]['quantidade'])) {
    $_SESSION['carrinho'][$id]['quantidade'] = 1;
}

$qtde = $_SESSION['carrinho'][$id]['quantidade'];
$totalItem = $produto['preco'] * $qtde;
$total += $totalItem;
?>

<div class="card">

<img src="<?= $produto['imagem']; ?>">

<div class="info">

<h3><?= $produto['nome']; ?></h3>

<span class="preco">
R$ <?= number_format($produto['preco'],2,',','.'); ?>
</span>

<div class="qtd">

<a href="carrinho.php?remover=<?= $id; ?>">-</a>

<form method="POST">
<input type="hidden" name="id" value="<?= $id; ?>">

<input type="number"
name="quantidade"
value="<?= $qtde; ?>"
min="1"
max="<?= $produto['estoque']; ?>">

<input type="hidden" name="atualizarQtd" value="1">
</form>

<?php if($qtde < $produto['estoque']): ?>
<a href="carrinho.php?aumentar=<?= $id; ?>">+</a>
<?php else: ?>
<span class="bloqueado">+</span>
<?php endif; ?>

</div>

</div>

<div class="acoes">

<span class="total-item">
R$ <?= number_format($totalItem,2,',','.'); ?>
</span>

<a class="remover" href="carrinho.php?removerTudo=<?= $id; ?>">
Remover
</a>

</div>

</div>

<?php endforeach; ?>

</div>

<div class="resumo">

<h2>Resumo</h2>

<div class="linha">
<span>Subtotal</span>
<span>R$ <?= number_format($total,2,',','.'); ?></span>
</div>

<div class="divisor"></div>

<div class="linha total">
<span>Total</span>
<span>R$ <?= number_format($total,2,',','.'); ?></span>
</div>

<a class="btn-finalizar" href="frete.php">
Finalizar compra
</a>

<a class="btn-limpar" href="carrinho.php?limpar=true">
Limpar carrinho
</a>

</div>

</div>

<?php endif; ?>

</div>

<script>
document.querySelectorAll('input[name="quantidade"]').forEach(input => {
    input.addEventListener('change', function(){
        this.closest('form').submit();
    });
});
</script>

</body>
</html>
