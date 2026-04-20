<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleContato.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Contato</title>
</head>
<body>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'enviado'): ?>
<div class="alerta">
<p>Mensagem enviada com sucesso!</p>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

<?php if(isset($_GET['erro']) && $_GET['erro'] == 'campos_vazios'): ?>
<div class="alerta">
<p>Preencha todos os campos!</p>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>


<?php
session_start();
?>

    <?php include 'includes/navbar.php'; ?>

    <div class="lados">

    <div class="lado-esquerdo">

    <h1 id="tittle">Entre em contato com a InfoGirls</h1>
    <p id="texto">Estamos prontos para atender você e oferecer as melhores soluções em
        tecnologia, informatização empresarial e equipamentos de informática. Nossa equipe está
        preparada para atender suas necessidades, esclarecer dúvidas e apresentar alternativas 
        personalizadas para o seu negócio ou projeto.<br><br>

        Seja para solicitar orçamento, obter suporte técnico, conhecer nossos serviços ou
        tirar dúvidas sobre os produtos e ou servicos, entre em contato conosco pelos canais
        abaixo ou preencha o formulário. Será um prazer falar com você e ajudar sua empresa
        a crescer com tecnologia e inovação.
    </p>

    <form action="actions/processa_contato.php" method="POST">
        <div class="linha">
        Nome:<input type="text" name="nome" required>
        E-mail:<input type="email" name="email" required>
        Assunto:<input type="text" name="assunto" placeholder>
        Mensagem:<textarea name="mensagem" required></textarea>
        <button type="submit">Enviar</button></div>
    </form>

    </div>

    <div class="lado-direito">

    <div class="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.3205443336874!2d-43.1830823!3d-22.901544899999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5ce80d17e1%3A0xdcd3ded523611621!2sAv.%20Mal.%20Floriano%2C%2063%20-%20Centro%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%2020080-004!5e0!3m2!1spt-BR!2sbr!4v1776391965201!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

    <div class="info">

        <p class="infos"><span>Endereço</span>
        <br>Av. Mal. Floriano, 63 Centro,<br>
            Rio de Janeiro - RJ 20080-002</p>

            <p class="infos"><span>Entre em contato:</span>
            <br>Telefone: +55 (21) 99999-9999<br>
                Email: infogirlsfive1@gmail.com<br></p>

                <p class="infos"><span>Horário de funcionamento</span>
                <br>Segunda a Sexta - 08h ás 18h</p>
    </div>

    </div>

    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>