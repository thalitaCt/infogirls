<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>InfoGirls</title>

    <link rel="stylesheet" href="css/styleGeral.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php if (isset($_GET['msg'])): ?>

<div class="alerta sucesso">

<?php

if ($_GET['msg'] == 'cadastrado'){
    echo "Conta criada com sucesso";
}

if ($_GET['msg'] == 'login_sucesso'){
    echo "Login realizado com sucesso";
}

?>

<span class="fechar"
onclick="this.parentElement.style.display='none'">
X
</span>

</div>

<?php endif; ?>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->

<section id="home">

    <div class="overlay"></div>

    <div class="hero-content">

        <span class="tag">
            Tecnologia • Desenvolvimento • Automação
        </span>

        <h1>
            Soluções inteligentes para empresas que querem crescer
        </h1>

        <p>
            Desenvolvemos sistemas, criamos sites profissionais e oferecemos equipamentos
            tecnológicos para modernizar empresas e transformar negócios através da tecnologia.
        </p>

        <div class="hero-buttons">

            <button class="btn orcamento">

                <a href="contato.php">

                    Solicitar orçamento
                    <i class="fa-solid fa-laptop-code"></i>

                </a>

            </button>

            <button class="btn produtos">

                <a href="produtos.php">

                    Ver produtos
                    <i class="fa-solid fa-cart-shopping"></i>

                </a>

            </button>

        </div>

    </div>

</section>

<!-- ESTATÍSTICAS -->

<section id="stats">

    <div class="stat-card">

        <i class="fa-solid fa-users"></i>

        <h2>120+</h2>

        <p>Clientes atendidos</p>

    </div>

    <div class="stat-card">

        <i class="fa-solid fa-computer"></i>

        <h2>300+</h2>

        <p>Equipamentos vendidos</p>

    </div>

    <div class="stat-card">

        <i class="fa-solid fa-code"></i>

        <h2>40+</h2>

        <p>Projetos desenvolvidos</p>

    </div>

    <div class="stat-card">

        <i class="fa-solid fa-headset"></i>

        <h2>24/7</h2>

        <p>Suporte especializado</p>

    </div>

</section>

<!-- SOBRE RÁPIDO -->

<section id="sobre-home">

    <div class="sobre-texto">

        <span class="mini-tag">
            SOBRE A INFOGIRLS
        </span>

        <h2>
            Tecnologia moderna com atendimento humanizado
        </h2>

        <p>
            A InfoGirls nasceu com o objetivo de unir tecnologia, praticidade e inovação
            em um único lugar. Trabalhamos com desenvolvimento de sistemas, criação de sites,
            suporte técnico e venda de equipamentos de informática.
        </p>

        <p>
            Nossa missão é ajudar empresas e pessoas a utilizarem a tecnologia de forma
            inteligente, moderna e eficiente.
        </p>

        <button class="btn">

            <a href="sobre.php">

                Conheça nossa história

            </a>

        </button>

    </div>

    <div class="sobre-imagem">

        <img src="imagens/geral2.avif">

    </div>

</section>

<!-- SERVIÇOS -->

<section id="servicos">

    <div class="titulo-section">

        <span class="mini-tag">
            NOSSOS SERVIÇOS
        </span>

        <h2>
            Soluções completas para o seu negócio
        </h2>

        <p>
            Oferecemos serviços modernos para empresas que desejam crescer com tecnologia.
        </p>

    </div>

    <div class="cards-servicos">

        <div class="card-servico">

            <i class="fa-solid fa-code"></i>

            <h3>
                Desenvolvimento de Sistemas
            </h3>

            <p>
                Sistemas personalizados para automatizar processos e melhorar a gestão da sua empresa.
            </p>

        </div>

        <div class="card-servico">

            <i class="fa-solid fa-globe"></i>

            <h3>
                Criação de Sites
            </h3>

            <p>
                Sites modernos, rápidos e responsivos para fortalecer sua presença digital.
            </p>

        </div>

        <div class="card-servico">

            <i class="fa-solid fa-screwdriver-wrench"></i>

            <h3>
                Suporte Técnico
            </h3>

            <p>
                Manutenção, configuração e suporte especializado para computadores e sistemas.
            </p>

        </div>

        <div class="card-servico">

            <i class="fa-solid fa-shield-halved"></i>

            <h3>
                Segurança Digital
            </h3>

            <p>
                Proteção de dados, segurança de sistemas e soluções para evitar problemas digitais.
            </p>

        </div>

    </div>

</section>

<!-- LOJA -->

<section id="loja-home">

    <div class="loja-imagem">

        <img src="imagens/geral4.jpg">

    </div>

    <div class="loja-texto">

        <span class="mini-tag">
            LOJA DE INFORMÁTICA
        </span>

        <h2>
            Equipamentos e peças com qualidade profissional
        </h2>

        <p>
            Trabalhamos com peças, periféricos e equipamentos para quem deseja montar,
            atualizar ou melhorar o desempenho do computador.
        </p>

        <ul>

            <li>
                <i class="fa-solid fa-check"></i>
                Computadores e notebooks
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                SSDs, memórias e upgrades
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Periféricos gamers e profissionais
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Equipamentos corporativos
            </li>

        </ul>

        <button class="btn">

            <a href="produtos.php">

                Explorar produtos

            </a>

        </button>

    </div>

</section>

<!-- DIFERENCIAIS -->

<section id="diferenciais">

    <div class="titulo-section">

        <span class="mini-tag">
            DIFERENCIAIS
        </span>

        <h2>
            Por que escolher a InfoGirls?
        </h2>

    </div>

    <div class="grid-diferenciais">

        <div class="diferencial">

            <i class="fa-solid fa-bolt"></i>

            <h3>
                Agilidade
            </h3>

            <p>
                Soluções rápidas e eficientes para atender as necessidades dos clientes.
            </p>

        </div>

        <div class="diferencial">

            <i class="fa-solid fa-user-group"></i>

            <h3>
                Atendimento Humanizado
            </h3>

            <p>
                Atendimento próximo, personalizado e focado em entender cada necessidade.
            </p>

        </div>

        <div class="diferencial">

            <i class="fa-solid fa-microchip"></i>

            <h3>
                Tecnologia Atualizada
            </h3>

            <p>
                Trabalhamos com ferramentas modernas e soluções alinhadas ao mercado atual.
            </p>

        </div>

        <div class="diferencial">

            <i class="fa-solid fa-headset"></i>

            <h3>
                Suporte Contínuo
            </h3>

            <p>
                Acompanhamento técnico e suporte para garantir estabilidade e segurança.
            </p>

        </div>

    </div>

</section>

<!-- DEPOIMENTOS -->

<section id="depoimentos">

    <div class="titulo-section">

        <span class="mini-tag">
            FEEDBACKS
        </span>

        <h2>
            O que nossos clientes dizem
        </h2>

    </div>

    <div class="cards-depoimentos">

        <div class="depoimento">

            <p>
                “Atendimento excelente e desenvolvimento muito profissional.
                O sistema ajudou bastante nossa empresa.”
            </p>

            <h4>
                Mariana Costa
            </h4>

        </div>

        <div class="depoimento">

            <p>
                “Comprei equipamentos e recebi suporte completo.
                Recomendo muito a InfoGirls.”
            </p>

            <h4>
                Rafael Mendes
            </h4>

        </div>

        <div class="depoimento">

            <p>
                “O site ficou moderno, rápido e muito bonito.
                Superou nossas expectativas.”
            </p>

            <h4>
                Juliana Freitas
            </h4>

        </div>

    </div>

</section>

<!-- CTA FINAL -->

<section id="cta">

    <div class="cta-content">

        <span class="mini-tag">
            VAMOS TRABALHAR JUNTOS?
        </span>

        <h2>
            Pronta para transformar sua empresa com tecnologia?
        </h2>

        <p>
            Entre em contato e descubra como podemos ajudar seu negócio
            a crescer com soluções digitais modernas e eficientes.
        </p>

        <button class="btn">

            <a href="contato.php">

                Fale Conosco

            </a>

        </button>

    </div>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
