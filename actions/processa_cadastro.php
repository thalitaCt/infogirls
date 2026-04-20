<?php
    include '../includes/conexao.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $nome = $_POST['nome'];
    $cpf_cnpj = preg_replace('/\D/', '',$_POST['cpf_cnpj']);
    $telefone = preg_replace('/\D/', '',$_POST['telefone']);
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $codigo = rand(100000, 999999);

    $sql = "SELECT * FROM CLIENTES WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../contas.php?erro=email_existente");
        exit;
    }

    $sql = "SELECT * FROM CLIENTES WHERE cpf_cnpj = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf_cnpj]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../contas.php?erro=cpf_cnpj");
        exit;
    }

    try {
    $sql = "INSERT INTO clientes (nome, cpf_cnpj, telefone, email, endereco, senha, codigo_verificacao, verificado) VALUES (?, ?, ?, ?, ?, ?, ?, false)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf_cnpj, $telefone, $email, $endereco, $senha, $codigo]);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'infogirlsfive1@gmail.com';
        $mail->Password = 'ymdf jfwn tnjw tual';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->setFrom('infogirlsfive1@gmail.com', 'InfoGirls');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verificação de conta';

        $mail->Body = "<h2>Seu código de verificação</h2>
        <p>Olá, $nome</p>
        <p>Seu código é:</p>
        
        <h1 style='letter-spacing:5px;'>$codigo</h1>
        
        <p>Digite esse código no site para ativar sua conta.</p>";

        $mail->send();
    } catch (Exception $e) {

    } header("Location: ../verificar.php?email=$email");
      exit;
    }  catch(PDOException $e) {
        header("Location: ../contas.php?erro=geral");
        exit;
    }
?>