<?php
session_start();

include '../includes/conexao.php';

if(!isset($_SESSION['usuario'])){
    header("Location: ../contas.php");
    exit;
}


if(empty($_SESSION['carrinho'])){
    header("Location: ../carrinho.php");
    exit;
}


$carrinho = $_SESSION['carrinho'];

$total = 0;


foreach($carrinho as $item){

    $total += $item['preco'] * $item['quantidade'];

}

$frete = $_SESSION['frete'] ?? 0;

$totalFinal = $total + $frete;


$endereco = $_SESSION['endereco_pedido'] ?? [];


if(empty($endereco)){
    header("Location: ../frete.php");
    exit;
}

$forma = $_POST['forma_pagamento'] ?? 'pix';

if($forma == 'pix'){

    $pago = 1;

} else {
    $pago = 0;
}

$statusPedido = 'Em preparação';


$enderecoCompleto =
($endereco['endereco'] ?? '') . ', ' .
($endereco['numero'] ?? '') . ' - ' .
($endereco['bairro'] ?? '') . ' - ' .
($endereco['cidade'] ?? '') . '/' .
($endereco['estado'] ?? '');


try{

    $pdo->beginTransaction();

    $sql = $pdo->prepare("
    INSERT INTO pedidos
    (
        cliente_email,
        cliente_nome,
        total,
        frete,
        endereco_entrega,
        regiao,
        status,
        pago,
        forma_pagamento,
        data_pedido
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");


    $sql->execute([
        $_SESSION['usuario'],
        $_SESSION['nome'],
        $totalFinal,
        $frete,
        $enderecoCompleto,
        $endereco['regiao'] ?? null,
        $statusPedido,
        $pago,
        $forma
    ]);

    $pedido_id = $pdo->lastInsertId();


    foreach($carrinho as $id => $item){

        $verifica = $pdo->prepare("
        SELECT estoque
        FROM produtos
        WHERE id_produto = ?
        ");

        $verifica->execute([$id]);

        $produto = $verifica->fetch(PDO::FETCH_ASSOC);

        if(!$produto){

            $pdo->rollBack();

            header("Location: ../carrinho.php?erro=produto");
            exit;
        }

        if($produto['estoque'] < $item['quantidade']){

            $pdo->rollBack();

            header("Location: ../carrinho.php?erro=estoque");
            exit;
        }

        $sqlItem = $pdo->prepare("
        INSERT INTO itens_pedido
        (
            pedido_id,
            produto_id,
            nome,
            quantidade,
            preco
        )
        VALUES (?, ?, ?, ?, ?)
        ");


        $sqlItem->execute([
            $pedido_id,
            $id,
            $item['nome'],
            $item['quantidade'],
            $item['preco']
        ]);

        $update = $pdo->prepare("
        UPDATE produtos
        SET estoque = estoque - ?
        WHERE id_produto = ?
        ");

        $update->execute([
            $item['quantidade'],
            $id
        ]);

    }

    $pdo->commit();

    $_SESSION['carrinho'] = [];

    unset($_SESSION['frete']);
    unset($_SESSION['endereco_pedido']);

    header("Location: ../confirmacao.php?pedido=$pedido_id");
    exit;

}catch(PDOException $e){
    die ($e->getMessage());

}
?>