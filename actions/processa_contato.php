<?php
include '../includes/conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../actions/PHPMailer/src/Exception.php';
require '../actions/PHPMailer/src/PHPMailer.php';
require '../actions/PHPMailer/src/SMTP.php';


$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');


if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
    header("Location: ../contato.php?erro=campos_vazios");
    exit;
}


try {
    $sql = $pdo->prepare("
        INSERT INTO contatos (nome, email, assunto, mensagem)
        VALUES (?, ?, ?, ?)
    ");


    $sql->execute([$nome, $email, $assunto, $mensagem]);


    $mail = new PHPMailer(true);


    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'infogirlsfive1@gmail.com';
    $mail->Password = 'ymdf jfwn tnjw tual';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;


    $mail->CharSet = 'UTF-8';


    $mail->setFrom('infogirlsfive1@gmail.com', 'Info Girls');
    $mail->addAddress('infogirlsfive1@gmail.com');


    $mail->isHTML(true);
    $mail->Subject = 'Novo contato recebido';


    $mail->Body = "
        <h2>Novo contato pelo site</h2>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Assunto:</strong> $assunto</p>
        <p><strong>Mensagem:</strong><br>$mensagem</p>
    ";


    $mail->send();


    header("Location: ../contato.php?msg=enviado");
    exit;


} catch (Exception $e) {
    header("Location: ../contato.php?erro=geral");
    exit;
}
?>