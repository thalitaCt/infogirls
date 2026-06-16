<?php
session_start();
include '../includes/conexao.php';

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
    header("Location: ../contas.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: usuarios.php");
    exit;
}

$id = intval($_GET['id']);

$sql = $pdo->prepare("
SELECT
    u.id_usuario,
    u.email,
    u.tipo,
    c.*
FROM usuarios u
LEFT JOIN clientes c
ON c.usuario_id = u.id_usuario
WHERE u.id_usuario = ?
");

$sql->execute([$id]);

$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if(!$usuario){
    header("Location: usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Usuário</title>

<link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="admin-layout">

<?php include 'includes/sidebar.php'; ?>

<div class="conteudo">

<div class="topo">
    <h1>Editar Usuário</h1>
</div>

<div class="form-admin">

<form action="salvar_usuario.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $usuario['id_usuario'] ?>">

<div class="input-group">
<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>"
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
value="<?= htmlspecialchars($usuario['telefone'] ?? '') ?>">
</div>

<div class="input-group">
<label>CEP</label>

<input
type="text"
name="cep"
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
