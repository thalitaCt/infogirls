<?php
session_start();
include '../includes/conexao.php';

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
    header("Location: ../contas.php");
    exit;
}

$id = $_GET['id'] ?? 0;

/* BUSCA O USUÁRIO */
$sql = $pdo->prepare("
SELECT *
FROM usuarios
WHERE id_usuario = ?
");

$sql->execute([$id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if(!$usuario){
    die("Usuário não encontrado.");
}

$tipo = $usuario['tipo'];

/* CLIENTE */
if($tipo == 'cliente'){

    $sqlDados = $pdo->prepare("
    SELECT *
    FROM clientes
    WHERE usuario_id = ?
    ");

    $sqlDados->execute([$id]);
    $dados = $sqlDados->fetch(PDO::FETCH_ASSOC);

}

/* ADMIN/FUNCIONÁRIO */
else{

    $sqlDados = $pdo->prepare("
    SELECT *
    FROM funcionarios
    WHERE usuario_id = ?
    ");

    $sqlDados->execute([$id]);
    $dados = $sqlDados->fetch(PDO::FETCH_ASSOC);

}

if($tipo == 'cliente'){

    $sqlDados = $pdo->prepare("
    SELECT *
    FROM clientes
    WHERE usuario_id = ?
    ");

    $sqlDados->execute([$id]);

    $cliente = $sqlDados->fetch(PDO::FETCH_ASSOC);

}else{

    $sqlDados = $pdo->prepare("
    SELECT *
    FROM funcionarios
    WHERE usuario_id = ?
    ");

    $sqlDados->execute([$id]);

    $funcionario = $sqlDados->fetch(PDO::FETCH_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Usuário</title>

<link
rel="stylesheet"
href="css/admin.css">

</head>
<body>

<div class="admin-layout">

<?php include 'includes/sidebar.php'; ?>

<div class="conteudo">

<div class="topo">

<h1>Editar Usuário</h1>

<p>
Atualize os dados do usuário.
</p>

</div>

<form method="POST" action="salvar_usuario.php" class="form-admin">
<input
type="hidden"
name="id"
value="<?= $usuario['id_usuario']; ?>">

<?php if($usuario['tipo'] == 'cliente'): ?>

<div class="grupo">
<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($cliente['nome']); ?>"
required>
</div>

<div class="grupo">
<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($usuario['email']); ?>"
required>
</div>

<div class="grupo">
<label>Telefone</label>

<input
type="text"
name="telefone"
value="<?= htmlspecialchars($cliente['telefone']); ?>"
required>
</div>

<div class="grupo">
<label>CEP</label>

<input
type="text"
name="cep"
value="<?= htmlspecialchars($cliente['cep']); ?>">
</div>

<div class="grupo">
<label>Número</label>

<input
type="text"
name="numero"
value="<?= htmlspecialchars($cliente['numero']); ?>">
</div>

<div class="grupo">
<label>Endereço</label>

<input
type="text"
name="endereco"
value="<?= htmlspecialchars($cliente['endereco']); ?>">
</div>

<div class="grupo">
<label>Bairro</label>

<input
type="text"
name="bairro"
value="<?= htmlspecialchars($cliente['bairro']); ?>">
</div>

<div class="grupo">
<label>Cidade</label>

<input
type="text"
name="cidade"
value="<?= htmlspecialchars($cliente['cidade']); ?>">
</div>

<div class="grupo">
<label>Estado</label>

<input
type="text"
name="estado"
value="<?= htmlspecialchars($cliente['estado']); ?>">
</div>

<div class="grupo">
<label>Região</label>

<input
type="text"
name="regiao"
value="<?= htmlspecialchars($cliente['regiao']); ?>">
</div>

<?php else: ?>

<div class="grupo">
<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($funcionario['nome']); ?>"
required>
</div>

<div class="grupo">
<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($usuario['email']); ?>"
required>
</div>

<div class="grupo">
<label>Telefone</label>

<input
type="text"
name="telefone"
value="<?= htmlspecialchars($funcionario['telefone']); ?>"
required>
</div>

<div class="grupo">
<label>Cargo</label>

<input
type="text"
value="<?= htmlspecialchars($funcionario['cargo']); ?>"
readonly>
</div>

<div class="grupo">
<label>Salário</label>

<input
type="number"
step="0.01"
name="salario"
value="<?= $funcionario['salario']; ?>">
</div>

<?php endif; ?>

<button
type="submit"
name="salvar"
class="btn-admin">

<i class="fa-solid fa-floppy-disk"></i>
Salvar Alterações

</button>

</form>

</div>

</div>

</body>
</html>
