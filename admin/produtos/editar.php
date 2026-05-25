<?php

session_start();

include '../../includes/conexao.php';

include '../../includes/cloudinary.php';

use Cloudinary\Api\Upload\UploadApi;

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
    $descricao = $_POST['descricao'];

    $imagemBanco = $produto['imagem'];

    /* NOVA IMAGEM */

    if(!empty($_FILES['imagem']['name'])){


    $imagem = $_FILES['imagem'];


    $extensao = strtolower(
    pathinfo($imagem['name'], PATHINFO_EXTENSION)
    );

    $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'jfif'];

    if(!in_array($extensao, $permitidas)){

        header("Location: editar.php?id=$id&erro=invalida");
        exit;

    }

    try{

    $upload = new UploadApi();

    $resultado = $upload->upload(

        $imagem['tmp_name'],

        [
            'folder' => 'infogirls/produtos'
        ]

    );

    $imagemBanco = $resultado['secure_url'];

}
catch(Exception $e){

    header("Location: editar.php?id=$id&erro=upload");
    exit;
}
}

    /* UPDATE */

    $update = $pdo->prepare("

    UPDATE produtos

    SET
    nome = ?,
    preco = ?,
    estoque = ?,
    descricao = ?,
    imagem = ?

    WHERE id_produtos = ?

    ");

    $update->execute([
        $nome,
        $preco,
        $estoque,
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

<?php if (isset($_GET['erro'])): ?>
<div class="alerta erro">

<i class="fa-solid fa-triangle-exclamation"></i>
<?php
if ($_GET['erro'] == 'invalida') echo "Envie uma imagem válida.";
if ($_GET['erro'] == 'formato') echo "Formato de imagem inválido.";
if ($_GET['erro'] == 'upload') echo "Erro ao enviar imagem.";

?>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

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

<label>Descrição</label>

<textarea
name="descricao"
required><?= $produto['descricao']; ?></textarea>

</div>

<div class="grupo">

<label>Imagem Atual</label>

<?php

if(str_contains($produto['imagem'], 'http')){

    $imagemProduto = $produto['imagem'];

}else{

    $imagemProduto = '../../' . $produto['imagem'];

}

?>

<img
src="<?= $imagemProduto; ?>"
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
