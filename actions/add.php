<?php
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../contas.php?erro=login");
    exit;
}

$id = $_POST['id'];
$acao = $_POST['acao'];

$sql = $pdo->prepare("SELECT * FROM produtos WHERE id_produtos = ?");
$sql->execute([$id]);

$produto = $sql->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header("Location: ../produtos.php?erro=produto");
    exit;
}

$nome = $produto['nome'];
$nomeCurto = mb_strimwidth($nome, 0, 35, "...");

if ($produto['estoque'] <= 0) {
    header("Location: ../produtos.php?erro=estoque");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$id])) {

    if ($_SESSION['carrinho'][$id]['quantidade'] < $produto['estoque']) {
    $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        header("Location: ../produtos.php?erro=limite_estoque");
        exit;
    }

} else {
    $_SESSION['carrinho'][$id] = [
        'id_produtos' => $produto['id_produtos'],
        'nome' => $produto['nome'],
        'preco' => $produto['preco'],
        'imagem' => $produto['imagem'],
        'estoque' => $produto['estoque'],
        'quantidade' => 1
    ];
}

if ($acao == "comprar") {
    header("Location: ../checkout.php");
} else {
    header ("Location: ../produtos.php?msg=adicionado&nome=$nomeCurto");
}
exit;
?>
