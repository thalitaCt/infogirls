<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

/* PEGAR PRODUTO */

if(!isset($_GET['id'])){
    header("Location: listar.php");
    exit;
}

$id = $_GET['id'];

$sql = $pdo->prepare("
SELECT * FROM produtos
WHERE id_produtos = ?
");

$sql->execute([$id]);

$produto = $sql->fetch(PDO::FETCH_ASSOC);

if(!$produto){
    header("Location: listar.php");
    exit;
}

/* EDITAR */

if(isset($_POST['editar'])){

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    $imagemBanco = $produto['imagem'];

    /* NOVA IMAGEM */

    if(!empty($_FILES['imagem']['name'])){

        $imagem = $_FILES['imagem'];

        $nomeImagem =
        uniqid() . "-" . $imagem['name'];

        $caminho =
        "../../uploads/" . $nomeImagem;

        move_uploaded_file(
        $imagem['tmp_name'],
        $caminho
        );

        $imagemBanco =
        "uploads/" . $nomeImagem;
    }

    /* UPDATE */

    $update = $pdo->prepare("

    UPDATE produtos

    SET
    nome = ?,
    preco = ?,
    estoque = ?,
    categoria = ?,
    descricao = ?,
    imagem = ?

    WHERE id_produtos = ?

    ");

    $update->execute([
        $nome,
        $preco,
        $estoque,
        $categoria,
        $descricao,
        $imagemBanco,
        $id
    ]);

    header("Location: listar.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar Produto</title>

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

    <h1>Editar Produto</h1>

    <p>
        Atualize as informações do produto.
    </p>

</div>

<form
method="POST"
enctype="multipart/form-data"
class="form-admin">

<div class="grupo">

<label>Nome do Produto</label>

<input
type="text"
name="nome"
value="<?= $produto['nome']; ?>"
required>

</div>

<div class="grupo">

<label>Preço</label>

<input
type="number"
step="0.01"
name="preco"
value="<?= $produto['preco']; ?>"
required>

</div>

<div class="grupo">

<label>Estoque</label>

<input
type="number"
name="estoque"
value="<?= $produto['estoque']; ?>"
required>

</div>

<div class="grupo">

<label>Categoria</label>

<input
type="text"
name="categoria"
value="<?= $produto['categoria']; ?>"
required>

</div>

<div class="grupo">

<label>Descrição</label>

<textarea
name="descricao"
required><?= $produto['descricao']; ?></textarea>

</div>

<div class="grupo">

<label>Imagem Atual</label>

<img
src="../../<?= $produto['imagem']; ?>"
class="preview-img">

</div>

<div class="grupo">

<label>Nova Imagem (Opcional)</label>

<input
type="file"
name="imagem">

</div>

<button
type="submit"
name="editar"
class="btn-admin">

<i class="fa-solid fa-pen"></i>
Salvar Alterações

</button>

</form>

</div>

</div>

</body>
</html>
