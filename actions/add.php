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

$nome = $produto['nome'];
$nomeCurto = mb_strimwidth($nome, 0, 35, "...");

if (!$produto) {
    header("Location: ../produtos.php?erro=produto");
    exit;
}

if ($produto['estoque'] <= 0) {
    header("Location: ../produtos.php?erro=estoque");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]['quantidade']++;
} else {
    $_SESSION['carrinho'][$id] = [
        'id' => $produto['id'],
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
