<?php
session_start();

include '../includes/conexao.php';

/* VERIFICA LOGIN */

if(!isset($_SESSION['usuario'])){
    header("Location: ../contas.php");
    exit;
}

/* ID USUÁRIO */

$idUsuario = $_SESSION['id'];

/* DADOS */

$nome = trim($_POST['nome']);
$telefone = preg_replace('/\D/', '', $_POST['telefone']);

$cep = preg_replace('/\D/', '', $_POST['cep']);

$endereco = trim($_POST['endereco']);
$numero = trim($_POST['numero']);
$bairro = trim($_POST['bairro']);
$cidade = trim($_POST['cidade']);

$estado = strtoupper(trim($_POST['estado']));

$regiao = trim($_POST['regiao']);

/* =========================
   VALIDAÇÕES
========================= */

/* NOME */

if(empty($nome)){

    header("Location: ../minha_conta.php?erro=nome_vazio");
    exit;
}

/* TELEFONE */

if(strlen($telefone) != 11){

    header("Location: ../minha_conta.php?erro=telefone_invalido");
    exit;
}

/* CEP */

if(strlen($cep) != 8){

    header("Location: ../minha_conta.php?erro=cep_invalido");
    exit;
}

/* ESTADOS */

$estadosValidos = [

"AC","AL","AP","AM","BA","CE","DF","ES","GO","MA",
"MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN",
"RS","RO","RR","SC","SP","SE","TO"

];

if(!in_array($estado, $estadosValidos)){

    header("Location: ../minha_conta.php?erro=estado_invalido");
    exit;
}

/* REGIÕES INFO GIRLS */

$regioesValidas = [

"Sudeste",
"Sul",
"Centro-Oeste",
"Nordeste",
"Norte"

];

if(!in_array($regiao, $regioesValidas)){

    header("Location: ../minha_conta.php?erro=regiao_invalida");
    exit;
}

/* ENDEREÇO INCOMPLETO */

if(

    empty($endereco) ||
    empty($numero) ||
    empty($bairro) ||
    empty($cidade)

){

    header("Location: ../minha_conta.php?erro=endereco_incompleto");
    exit;
}

/* =========================
   ATUALIZA DADOS
========================= */

$sql = $pdo->prepare("

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

/* EXECUTA */

$sql->execute([

    $nome,
    $telefone,
    $cep,
    $endereco,
    $numero,
    $bairro,
    $cidade,
    $estado,
    $regiao,
    $idUsuario

]);

/* ATUALIZA SESSÃO */

$_SESSION['nome'] = $nome;

/* REDIRECT */

header("Location: ../minha_conta.php?msg=salvo");

exit;
?>
