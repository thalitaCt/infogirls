<?php

session_start();

include '../../includes/conexao.php';

include '../includes/verificar_admin.php';

if(isset($_POST['cadastrar'])){

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    /* IMAGEM */

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

    /* INSERT */

    $sql = $pdo->prepare("

    INSERT INTO produtos
    (
    nome,
    preco,
    estoque,
    categoria,
    descricao,
    imagem
    )

    VALUES
    (?, ?, ?, ?, ?, ?)

    ");

    $sql->execute([
        $nome,
        $preco,
        $estoque,
        $categoria,
        $descricao,
        $imagemBanco
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

<title>Adicionar Produto</title>

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

    <h1>Adicionar Produto</h1>

    <p>
        Cadastre um novo produto na loja.
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
required>

</div>

<div class="grupo">

<label>Preço</label>

<input
type="number"
step="0.01"
name="preco"
required>

</div>

<div class="grupo">

<label>Estoque</label>

<input
type="number"
name="estoque"
required>

</div>

<div class="grupo">

<label>Categoria</label>

<input
type="text"
name="categoria"
required>

</div>

<div class="grupo">

<label>Descrição</label>

<textarea
name="descricao"
required></textarea>

</div>

<div class="grupo">

<label>Imagem</label>

<input
type="file"
name="imagem"
required>

</div>

<button
type="submit"
name="cadastrar"
class="btn-admin">

<i class="fa-solid fa-floppy-disk"></i>
Cadastrar Produto

</button>

</form>

</div>

</div>

</body>
</html>
