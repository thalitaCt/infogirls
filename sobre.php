<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleSobre.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Sobre</title>
</head>
<body>
    
<?php
session_start();
?>

    <?php include 'includes/navbar.php'; ?>

    <h1 id="tittle">Sobre Nós</h1>

    <p id="texto">
        A InfoGirls nasceu durante o curso técnico em Informática, quando cinco meninas perceberam que, apesar de <br>terem habilidades diferentes, trabalhavam muito bem juntas. Elas se destacaram em projetos acadêmicos, combinando conhecimento em hardware,<br> desenvolvimento de software, design, redes, análise de dados, gestão e resolução de problemas.

<br><br>
Durante uma feira tecnológica, criaram um sistema simples que chamou a atenção de visitantes e pequenos empreendedores.<br> A partir disso, surgiu a ideia de levar o trabalho além da sala de aula. Unidas pela vontade de mostrar a força feminina na tecnologia, decidiram<br> formar uma empresa própria.

<br><br>
No começo, enfrentaram desafios, como conquistar clientes e superar preconceitos, mas a parceria e o apoio mútuo fortaleceram<br> o grupo. Assim, a InfoGirls consolidou sua identidade como uma empresa dedicada a oferecer soluções completas em tecnologia, comprovando<br> que mulheres têm lugar de protagonismo na informática.
    </p>

    <div class="imagens">
    <img src="imagens/geral5.jpg">
    <div id="destaque"><img src="imagens/geral6.jpg"></div>
    <img src="imagens/geral7.png">
</div>

        <div class="cards">

            <div class="card">
            <i class="fa-solid fa-bullseye"></i>
            <h2>Missão</h2>
            <p>Oferecer soluções tecnológicas que facilitem e 
                automotizem processos empresariais.</p>
            </div>

            <div class="card">
            <i class="fa-solid fa-eye"></i>
            <h2>Visão</h2>
            <p>Ser referência em inovação e informatização de 
                empresas de pequeno e médio porte.</p>
            </div>

            <div class="card">
            <i class="fa-solid fa-star"></i>
            <h2>Valores</h2>
            <p>Inovação, comprometimento, transparência e qualidade.</p>
            </div>
        </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>