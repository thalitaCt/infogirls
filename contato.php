<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contato</title>

    <link rel="stylesheet" href="css/styleContato.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'enviado'): ?>

<div class="alerta">

    <i class="fa-solid fa-circle-check"></i>

    <p>Mensagem enviada com sucesso!</p>

    <span class="fechar"
    onclick="this.parentElement.style.display='none'">
    X
    </span>

</div>

<?php endif; ?>

<?php if(isset($_GET['erro']) && $_GET['erro'] == 'campos_vazios'): ?>

<div class="alerta erro">

    <i class="fa-solid fa-triangle-exclamation"></i>

    <p>Preencha todos os campos!</p>

    <span class="fechar"
    onclick="this.parentElement.style.display='none'">
    X
    </span>

</div>

<?php endif; ?>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->

<section class="hero-contato">

    <div class="overlay"></div>

    <div class="hero-content">

        <span class="mini-title">
            SUPORTE • ORÇAMENTOS • TECNOLOGIA
        </span>

        <h1>
            Entre em contato com a
            <span>InfoGirls</span>
        </h1>

        <p>
            Estamos preparados para ajudar sua empresa com soluções
            tecnológicas modernas, suporte técnico especializado,
            desenvolvimento de sistemas e equipamentos de informática.
        </p>

    </div>

</section>

<!-- CONTEÚDO -->

<section class="contato-container">

    <!-- ESQUERDA -->

    <div class="lado-esquerdo">

        <div class="topo-texto">

            <span class="tag">
                Fale com nossa equipe
            </span>

            <h2 id="tittle">
                Vamos transformar sua empresa com tecnologia
            </h2>

            <p id="texto">

                A InfoGirls oferece soluções completas em tecnologia,
                desenvolvimento de sistemas, informatização empresarial
                e suporte especializado.

                <br><br>

                Nossa equipe está pronta para entender suas necessidades,
                esclarecer dúvidas e encontrar a melhor solução para o
                seu projeto, empresa ou negócio.

                <br><br>

                Seja para solicitar um orçamento, conhecer nossos serviços,
                comprar equipamentos ou obter suporte técnico, teremos
                prazer em ajudar.

            </p>

        </div>

        <!-- FORM -->

        <div class="form-card">

            <h3>
                Envie sua mensagem
            </h3>

            <form action="actions/processa_contato.php" method="POST">

                <div class="linha">
                                        <div class="grupo">

                        <label>
                            Nome completo
                        </label>

                        <input
                        type="text"
                        name="nome"
                        placeholder="Digite seu nome"
                        required>

                    </div>

                    <div class="grupo">

                        <label>
                            E-mail
                        </label>

                        <input
                        type="email"
                        name="email"
                        placeholder="Digite seu e-mail"
                        required>

                    </div>

                    <div class="grupo">

    <label>
        Assunto
    </label>

    <select name="assunto" required>

        <option value="">
            Selecione um assunto
        </option>

        <option value="Orçamento">
            Solicitar orçamento
        </option>

        <option value="Suporte Técnico">
            Suporte técnico
        </option>

        <option value="Desenvolvimento de Sistemas">
            Desenvolvimento de sistemas
        </option>

        <option value="Criação de Sites">
            Criação de sites
        </option>

        <option value="Produtos">
            Produtos e equipamentos
        </option>

        <option value="Parceria">
            Parcerias
        </option>

        <option value="Outro">
            Outro assunto
        </option>

    </select>

                    </div>

                    <div class="grupo">

                        <label>
                            Mensagem
                        </label>

                        <textarea
                        name="mensagem"
                        placeholder="Digite sua mensagem..."
                        required></textarea>

                </div>

                    <button type="submit">

                        <i class="fa-solid fa-paper-plane"></i>

                        Enviar mensagem

                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- DIREITA -->

    <div class="lado-direito">

        <!-- MAPA -->

        <div class="mapa-card">

            <div class="mapa-topo">

                <h3>
                    Nossa localização
                </h3>

                <p>
                    Rio de Janeiro • RJ
                </p>

            </div>

            <div class="mapa">

                <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.3205443336874!2d-43.1830823!3d-22.901544899999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5ce80d17e1%3A0xdcd3ded523611621!2sAv.%20Mal.%20Floriano%2C%2063%20-%20Centro%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%2020080-004!5e0!3m2!1spt-BR!2sbr!4v1776391965201!5m2!1spt-BR!2sbr"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>

        </div>

        <!-- INFOS -->

        <div class="info">

            <div class="infos">

                <div class="icone-info">

                    <i class="fa-solid fa-location-dot"></i>

                </div>

                <div>

                    <span>
                        Endereço
                    </span>

                    <p>

                        Av. Mal. Floriano, 63
                        <br>
                        Centro, Rio de Janeiro - RJ
                        <br>
                        CEP: 20080-004

                    </p>

                </div>

            </div>

            <div class="infos">

                <div class="icone-info">

                    <i class="fa-solid fa-phone"></i>

                </div>

                <div>

                    <span>
                        Atendimento
                    </span>

                    <p>

                        +55 (21) 99999-9999
                        <br>
                        infogirlsfive1@gmail.com

                    </p>

                </div>

            </div>

            <div class="infos">

                <div class="icone-info">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <div>

                    <span>
                        Horário de funcionamento
                    </span>

                    <p>

                        Segunda a Sexta
                        <br>
                        08h às 18h

                    </p>

                </div>

            </div>

        </div>

        <!-- EXTRA -->

        <div class="extra-card">

            <h3>
                Por que escolher a InfoGirls?
            </h3>

            <div class="extra-itens">

                <div class="extra-item">

                    <i class="fa-solid fa-check"></i>

                    <p>
                        Atendimento personalizado
                    </p>

                </div>

                <div class="extra-item">

                    <i class="fa-solid fa-check"></i>

                    <p>
                        Soluções tecnológicas modernas
                    </p>

                </div>

                <div class="extra-item">

                    <i class="fa-solid fa-check"></i>

                    <p>
                        Equipe especializada em TI
                    </p>

                </div>

                <div class="extra-item">

                    <i class="fa-solid fa-check"></i>

                    <p>
                        Suporte técnico contínuo
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
