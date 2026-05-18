<?php 
session_start();
include 'includes/conexao.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$carrinho = $_SESSION['carrinho'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Carrinho</title>

<link rel="stylesheet" href="css/styleCarrinho.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

    <div class="topo">
        <h1><i class="fa-solid fa-cart-shopping"></i> Seu Carrinho</h1>
        <p>Revise seus produtos antes de finalizar a compra</p>
    </div>

<?php if (empty($carrinho)): ?>

    <div class="vazio">
        <i class="fa-solid fa-box-open"></i>
        <h2>Seu carrinho está vazio</h2>
        <a href="produtos.php">Ver produtos</a>
    </div>

<?php else: ?>

<div class="layout">

    <!-- LISTA -->
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
                <span class="preco">R$ <?= number_format($produto['preco'],2,',','.'); ?></span>

                <div class="qtd">

                    <a href="carrinho.php?remover=<?= $id; ?>">-</a>

                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="number" name="quantidade" value="<?= $qtde; ?>" min="1" max="<?= $produto['estoque']; ?>">
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
                <span class="total-item">R$ <?= number_format($totalItem,2,',','.'); ?></span>
                <a class="remover" href="carrinho.php?removerTudo=<?= $id; ?>">Remover</a>
            </div>

        </div>

        <?php endforeach; ?>

    </div>

    <!-- RESUMO -->
    <div class="resumo">

        <h2>Resumo do Pedido</h2>

        <div class="linha">
            <span>Subtotal</span>
            <span>R$ <?= number_format($total,2,',','.'); ?></span>
        </div>

        <div class="linha">
            <span>Frete</span>
            <span>Calculado no checkout</span>
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
    input.addEventListener('change', function () {
        this.closest('form').submit();
    });
});
</script>

</body>
</html>
