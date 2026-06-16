<?php

session_start();
include '../includes/conexao.php';
include 'includes/verificar_admin.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: usuarios.php");
    exit;
}

$id = $_POST['id'];

/* DESCOBRE O TIPO */

$sql = $pdo->prepare("
SELECT tipo
FROM usuarios
WHERE id_usuario = ?
");

$sql->execute([$id]);

$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if(!$usuario){
    header("Location: usuarios.php");
    exit;
}

$tipo = $usuario['tipo'];

/* DADOS EM COMUM */

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);

$telefone = preg_replace(
'/\D/',
'',
$_POST['telefone']
);

/* VALIDA TELEFONE */

if(strlen($telefone) != 11){

    header(
    "Location: editar_usuario.php?id=$id&erro=telefone"
    );

    exit;
}

/* ATUALIZA EMAIL */

$updateUsuario = $pdo->prepare("
UPDATE usuarios
SET email = ?
WHERE id_usuario = ?
");

$updateUsuario->execute([
$email,
$id
]);

/* CLIENTE */

if($tipo == 'cliente'){

    $cep = preg_replace(
    '/\D/',
    '',
    $_POST['cep']
    );

    $endereco = trim($_POST['endereco']);
    $numero = trim($_POST['numero']);
    $bairro = trim($_POST['bairro']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);
    $regiao = trim($_POST['regiao']);

    $updateCliente = $pdo->prepare("

    UPDATE clientes

    SET
    nome = ?,
    telefone = ?,
    cep = ?,
    endereco = ?,
    numero = ?,
    bairro = ?,
    cidade = ?,
    estado = ?,
    regiao = ?

    WHERE usuario_id = ?

    ");

    $updateCliente->execute([

        $nome,
        $telefone,
        $cep,
        $endereco,
        $numero,
        $bairro,
        $cidade,
        $estado,
        $regiao,
        $id

    ]);

}

/* ADMIN */

else{

    $salario = $_POST['salario'];

    $updateFuncionario = $pdo->prepare("

    UPDATE funcionarios

    SET
    nome = ?,
    telefone = ?,
    salario = ?

    WHERE usuario_id = ?

    ");

    $updateFuncionario->execute([

        $nome,
        $telefone,
        $salario,
        $id

    ]);
}

header("Location: usuarios.php?msg=editado");
exit;