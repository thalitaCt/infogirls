<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleGeral.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>InfoGirls</title>
</head>
<body>

<?php
session_start();
?>

<?php if (isset($_GET['msg'])): ?>
<div class="alerta-sucesso">
<?php
if ($_GET['msg'] == 'cadastrado') echo "Conta criada com sucesso";
if ($_GET['msg'] == 'login_sucesso') echo "Login realizado com sucesso";
?>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

    <?php include 'includes/navbar.php'; ?>

    <section id="home">
        <div class="overlay"></div>
        <h1>Transformamos empresas com<br> tecnologia inteligente</h1>
        <p>Desenvolvemos soluções digitais, automatizamos processos<br> e oferecemos os melhores
            equipamentos para o seu negócio crescer.</p>
            <button class="btn orcamento"><a href="contato.php">Solicitar orçamento <i class="fa-solid fa-laptop-code"></i></a></button>
            <button class="btn produtos"><a href="produtos.php">Ver produtos <i class="fa-solid fa-cart-shopping"></i></a></button>
    </section>

    <section id="mid">

    <div class="bloco">
        <div id="informatizacao">
            <img src="imagens/geral2.avif">
        <h1>Soluções em Informatização</h1>
        <p>Modernize sua empresa com sistemas personalizados, automação de tarefas e tecnologia
            que facilita o dia a dia do seu negócio.</p>
            <button class="btn"><a href="sobre.php">Saiba Mais</a></button>
        </div>

        <div id="loja">
            <img src="imagens/geral4.jpg">
            <h1>Nossa Loja</h1>
                <p>Encontre peças e equipamentos de qualidade para montar, atualizar ou manter seu
                    computador com alto desempenho.</p>
                    <button class="btn"><a href="produtos.php">Ver Produtos</a></button>
        </div>
    </div>

        <div id="servico">
            <h1>Nossos Serviços</h1>

            <div class="cards">
            <div class="card">
                <i class="fa-solid fa-code"></i>
                <h2>Desenvolvimento <br>de Sistemas</h2>
                <p>Soluções personalizadas <br>para sua empresa</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-globe"></i>
                <h2>Criação de Sites</h2>
                <p>Sites modernos, responsivos e profissionais</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <h2>Suporte Técnico</h2>
                <p>Manutenção e suporte<br> personalizado</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-lock"></i>
                <h2>Segurança Digital</h2>
                <p>Proteção de dados e sistemas</p>
            </div>
            </div>

        </div>

        <div id="escolher">
            <h1>Por que escolher a gente?</h1>
            <p>Oferecemos soluções tecnológicas completas, unido desenvolvimento de sistemas<br>
                e venda de equipamentos para garantir praticidade e eficiência para nossos clientes.</p>
        <div class="opcoes">

        <i class="fa-solid fa-check"></i> Atendimento personalizado<br>
        <i class="fa-solid fa-check"></i> Soluções sob medida<br>
        <i class="fa-solid fa-check"></i> Tecnologia atualizada<br>
        <i class="fa-solid fa-check"></i> Suporte contínuo<br>
        </div>
            </div>

        <div id="cta">
            <h2>Pronto para transformar o seu negócio?</h2>
            <p>Entre em contato e descubra como podemos ajudar <br>sua empresa a crescer com tecnologia.</p>
            <button class="btn"><a href="contato.php">Fale Conosco</a></button>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>