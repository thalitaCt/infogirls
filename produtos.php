<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleProdutos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Produtos</title>
</head>
<body>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'adicionado'): ?>
    
<div class="alerta" id="alerta">

<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>

<span><?php echo $_GET['nome']; ?> adicionado ao Carrinho</span>
    </div>

    <?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
<div class="alerta">
<?php
if ($_GET['erro'] == 'estoque') echo "Produto sem estoque";
if ($_GET['erro'] == 'produto') echo "Produto não encontrado";
?>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

<?php
session_start();
include 'includes/conexao.php';

    $sql = $pdo->query("SELECT * FROM produtos ORDER BY id_produtos");
    $produtos = $sql->fetchAll();
?>
    <?php include 'includes/navbar.php'; ?>
        <h2 id="tittle">Nossos Produtos</h2>

        <div class="produtos">

        <?php foreach($produtos as $p): ?>

            <?php $estoque = $p['estoque']; ?>

        <div class="produto <?php if($p['estoque'] <= 0) echo 'sem-estoque'; ?>">
            <img src="<?= $p['imagem']; ?>">
            <h3><?=  $p['nome']; ?></h3>
            <p><?= $p['descricao']; ?></p>
            <span>R$ <?=  number_format($p['preco'],2,',','.'); ?></span>
            <p>Estoque: <?= $p['estoque']; ?></p>

            <form action="actions/add.php" method="POST">
                <input type="hidden" name="id" value="<?= $p['id_produtos']; ?>">

                <?php if($p['estoque'] > 0): ?>
                    <div class="acoes">
                    <button type="submit" name="acao" value="comprar">Comprar Agora</button>
                    <button type="submit" name="acao" value="adicionar">Adicionar ao Carrinho</button>
                    </div>

                    <?php else: ?>
                        <button disabled>Esgotado</button>
                    <?php endif; ?>
            </form>
        </div>

        <?php endforeach; ?>

        </div>
        
    <?php include 'includes/footer.php'; ?>
</body>
</html>