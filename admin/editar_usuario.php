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

<div class="conteudo">

<h1>Editar Usuário</h1>

<form action="salvar_usuario.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $id ?>">

<input
type="hidden"
name="tipo"
value="<?= $tipo ?>">

<div class="input-group">

<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($dados['nome']) ?>"
required>

</div>

<div class="input-group">

<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($usuario['email']) ?>"
required>

</div>

<div class="input-group">

<label>Telefone</label>

<input
type="text"
name="telefone"
value="<?= htmlspecialchars($dados['telefone']) ?>"
required>

</div>

<?php if($tipo == 'cliente'): ?>

<div class="input-group">
<label>CEP</label>

<input
type="text"
name="cep"
value="<?= $dados['cep'] ?>">
</div>

<div class="input-group">
<label>Endereço</label>

<input
type="text"
name="endereco"
value="<?= $dados['endereco'] ?>">
</div>

<div class="input-group">
<label>Número</label>

<input
type="text"
name="numero"
value="<?= $dados['numero'] ?>">
</div>

<div class="input-group">
<label>Bairro</label>

<input
type="text"
name="bairro"
value="<?= $dados['bairro'] ?>">
</div>

<div class="input-group">
<label>Cidade</label>

<input
type="text"
name="cidade"
value="<?= $dados['cidade'] ?>">
</div>

<div class="input-group">
<label>Estado</label>

<input
type="text"
name="estado"
value="<?= $dados['estado'] ?>">
</div>

<div class="input-group">
<label>Região</label>

<input
type="text"
name="regiao"
value="<?= $dados['regiao'] ?>">
</div>

<?php else: ?>

<div class="input-group">
<label>Cargo</label>

<input
type="text"
name="cargo"
value="<?= $dados['cargo'] ?>"
readonly>
</div>

<div class="input-group">
<label>Salário</label>

<input
type="number"
step="0.01"
name="salario"
value="<?= $dados['salario'] ?>">
</div>

<?php endif; ?>

<button type="submit">
Salvar Alterações
</button>

</form>

</div>

</body>
</html>name="cep"
value="<?= htmlspecialchars($usuario['cep'] ?? '') ?>">
</div>

<div class="input-group">
<label>Endereço</label>

<input
type="text"
name="endereco"
value="<?= htmlspecialchars($usuario['endereco'] ?? '') ?>">
</div>

<div class="input-group">
<label>Número</label>

<input
type="text"
name="numero"
value="<?= htmlspecialchars($usuario['numero'] ?? '') ?>">
</div>

<div class="input-group">
<label>Bairro</label>

<input
type="text"
name="bairro"
value="<?= htmlspecialchars($usuario['bairro'] ?? '') ?>">
</div>

<div class="input-group">
<label>Cidade</label>

<input
type="text"
name="cidade"
value="<?= htmlspecialchars($usuario['cidade'] ?? '') ?>">
</div>

<div class="input-group">
<label>Estado</label>

<input
type="text"
name="estado"
value="<?= htmlspecialchars($usuario['estado'] ?? '') ?>">
</div>

<div class="input-group">
<label>Região</label>

<input
type="text"
name="regiao"
value="<?= htmlspecialchars($usuario['regiao'] ?? '') ?>">
</div>

<div class="input-group">
<label>Tipo</label>

<input
type="text"
value="<?= htmlspecialchars($usuario['tipo']) ?>"
readonly>
</div>

<button type="submit" class="btn-admin">
Salvar Alterações
</button>

</form>

</div>

</div>

</div>

</body>
</html>
