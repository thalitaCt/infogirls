<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

$sql = $pdo->query("
SELECT * FROM produtos
ORDER BY id_produtos DESC
");

$produtos = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Produtos</title>

<link
rel="stylesheet"
href="../css/admin.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<div class="admin-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="conteudo">

<div class="topo">

    <h1>Produtos</h1>

    <p>
        Gerencie os produtos da loja.
    </p>

</div>

<a href="adicionar.php" class="btn-admin">
    <i class="fa-solid fa-plus"></i>
    Novo Produto
</a>

<div class="tabela-container">

<table class="tabela">

<thead>

<tr>

<th>Imagem</th>
<th>Nome</th>
<th>Preço</th>
<th>Estoque</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($produtos as $produto): ?>

<tr>

<td>

<img
src="<?= $produto['imagem']; ?>"
class="img-tabela">

</td>

<td>
<?= $produto['nome']; ?>
</td>

<td>

R$
<?= number_format(
$produto['preco'],
2,
',',
'.'
); ?>

</td>

<td>
<?= $produto['estoque']; ?>
</td>

<td class="acoes-tabela">

<a
href="editar.php?id=<?= $produto['id_produtos']; ?>"
class="editar">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="excluir.php?id=<?= $produto['id_produtos']; ?>"
class="excluir">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>
