<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

$sql = $pdo->query("

SELECT *
FROM contatos
ORDER BY id_contatos DESC

");

$mensagens = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Mensagens</title>

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

<h1>Mensagens</h1>

<p>
Mensagens recebidas pelo formulário de contato.
</p>

</div>

<div class="tabela-container">

<table class="tabela">

<thead>

<tr>

<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Assunto</th>
<th>Data</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($mensagens as $msg): ?>

<tr>

<td>
<?= $msg['id_contatos']; ?>
</td>

<td>
<?= $msg['nome']; ?>
</td>

<td>
<?= $msg['email']; ?>
</td>

<td>
<?= $msg['assunto']; ?>
</td>

<td>

<?= date(
'd/m/Y',
strtotime($msg['data_envio'])
); ?>

</td>

<td class="acoes-tabela">

<a
href="visualizar.php?id=<?= $msg['id_contatos']; ?>"
class="editar">

<i class="fa-solid fa-eye"></i>

</a>

<a
href="excluir.php?id=<?= $msg['id_contatos']; ?>"
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
