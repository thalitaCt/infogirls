<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Sobre</title>

    <link rel="stylesheet" href="css/styleSobre.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->

<section id="sobre-hero">

    <div class="overlay"></div>

    <div class="hero-content">

        <span class="mini-tag">
            SOBRE A INFOGIRLS
        </span>

        <h1>
            Tecnologia criada por mulheres que acreditam em inovação
        </h1>

        <p>
            Uma empresa desenvolvida a partir da união de criatividade,
            conhecimento técnico e paixão pela tecnologia.
        </p>

    </div>

</section>

<!-- HISTÓRIA -->

<section id="historia">

    <div class="historia-texto">

        <span class="mini-tag">
            NOSSA HISTÓRIA
        </span>

        <h2>
            Como tudo começou
        </h2>

        <p>
            A InfoGirls nasceu durante o curso técnico em Informática,
            quando cinco meninas perceberam que, apesar de terem habilidades
            diferentes, trabalhavam extremamente bem juntas.
        </p>

        <p>
            O grupo começou a se destacar em projetos acadêmicos,
            unindo conhecimentos em hardware, desenvolvimento de software,
            design, redes, análise de dados, gestão e resolução de problemas.
        </p>

        <p>
            Durante uma feira tecnológica, elas desenvolveram um sistema simples
            que chamou a atenção de visitantes e pequenos empreendedores.
            A partir desse momento, surgiu a ideia de transformar os projetos
            em algo maior.
        </p>

        <p>
            Mais do que criar soluções digitais, a InfoGirls surgiu para mostrar
            que mulheres também possuem espaço de protagonismo no universo da tecnologia.
        </p>

    </div>

    <div class="historia-imagem">

        <img src="imagens/geral5.jpg">

    </div>

</section>

<!-- GALERIA -->

<section id="galeria">

    <div class="titulo-section">

        <span class="mini-tag">
            NOSSO DIA A DIA
        </span>

        <h2>
            Criatividade, tecnologia e trabalho em equipe
        </h2>

    </div>

    <div class="imagens">

        <img src="imagens/geral5.jpg">

        <div class="destaque">

            <img src="imagens/geral6.jpg">

        </div>

        <img src="imagens/geral7.png">

    </div>

</section>

<!-- DIFERENCIAIS -->

<section id="diferenciais">

    <div class="titulo-section">

        <span class="mini-tag">
            O QUE NOS TORNA DIFERENTES
        </span>

        <h2>
            Muito além da tecnologia
        </h2>

        <p>
            Trabalhamos com soluções modernas, atendimento próximo
            e foco total em inovação.
        </p>

    </div>

    <div class="cards-diferenciais">

        <div class="card-diferencial">

            <i class="fa-solid fa-lightbulb"></i>

            <h3>
                Criatividade
            </h3>

            <p>
                Buscamos soluções inteligentes e modernas para cada projeto.
            </p>

        </div>

        <div class="card-diferencial">

            <i class="fa-solid fa-users"></i>

            <h3>
                Trabalho em Equipe
            </h3>

            <p>
                A colaboração entre diferentes áreas fortalece nossos resultados.
            </p>

        </div>

        <div class="card-diferencial">

            <i class="fa-solid fa-laptop-code"></i>

            <h3>
                Tecnologia Atualizada
            </h3>

            <p>
                Trabalhamos com ferramentas modernas e soluções eficientes.
            </p>

        </div>

        <div class="card-diferencial">

            <i class="fa-solid fa-heart"></i>

            <h3>
                Paixão pelo que Fazemos
            </h3>

            <p>
                Desenvolvemos projetos com dedicação e comprometimento.
            </p>

        </div>

    </div>

</section>

<!-- MISSÃO VISÃO VALORES -->

<section id="mvv">

    <div class="titulo-section">

        <span class="mini-tag">
            NOSSA ESSÊNCIA
        </span>

        <h2>
            Missão, visão e valores
        </h2>

    </div>

    <div class="cards">

        <div class="card">

            <i class="fa-solid fa-bullseye"></i>

            <h3>
                Missão
            </h3>

            <p>
                Oferecer soluções tecnológicas modernas que facilitem,
                automatizem e melhorem processos empresariais.
            </p>

        </div>

        <div class="card">

            <i class="fa-solid fa-eye"></i>

            <h3>
                Visão
            </h3>

            <p>
                Ser referência em inovação, informatização e desenvolvimento
                tecnológico para empresas de pequeno e médio porte.
            </p>

        </div>

        <div class="card">

            <i class="fa-solid fa-star"></i>

            <h3>
                Valores
            </h3>

            <p>
                Inovação, criatividade, transparência, inclusão,
                qualidade e compromisso com nossos clientes.
            </p>

        </div>

    </div>

</section>

<!-- NÚMEROS -->

<section id="numeros">

    <div class="numero-card">

        <h2>
            5
        </h2>

        <p>
            Fundadoras
        </p>

    </div>

    <div class="numero-card">

        <h2>
            40+
        </h2>

        <p>
            Projetos realizados
        </p>

    </div>

    <div class="numero-card">

        <h2>
            120+
        </h2>

        <p>
            Clientes atendidos
        </p>

    </div>

    <div class="numero-card">

        <h2>
            100%
        </h2>

        <p>
            Comprometimento
        </p>

    </div>

</section>

<!-- CTA -->

<section id="cta">

    <div class="cta-content">

        <span class="mini-tag">
            VAMOS CONVERSAR?
        </span>

        <h2>
            Quer transformar seu negócio com tecnologia?
        </h2>

        <p>
            Entre em contato com a InfoGirls e descubra soluções modernas
            para sua empresa crescer com inovação.
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
