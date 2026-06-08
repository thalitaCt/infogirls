<?php
session_start();
include 'includes/navbar.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serviços - InfoGirls</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


:root{
    --roxo: #7660b3;
    --roxo2: #584194;
    --roxo3: #4a347f;
    --roxo4: #2d1d52;


    --branco: #fff;
    --cinza: #d1d5db;
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Poppins;
}


body{
    background:
    linear-gradient(
    180deg,
    #0f0a24,
    #1b1140,
    #2e1065
    );


    color:white;
}


/* HERO */


.hero{
    position:relative;
    height:600px;


    background:
    linear-gradient(
    rgba(0,0,0,0.65),
    rgba(0,0,0,0.75)
    ),


    url('imagens/banner-servicos.jpg') center/cover;


    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;


    padding:20px;
}


.hero-content{
    max-width:900px;
}


.hero h1{
    font-size:60px;
    margin-bottom:20px;
}


.hero p{
    font-size:20px;
    color:var(--cinza);
    line-height:1.8;
}


/* SERVIÇOS */


.servicos{
    max-width:1400px;
    margin:auto;
    padding:100px 30px;
}


.titulo{
    text-align:center;
    margin-bottom:70px;
}


.titulo h2{
    font-size:42px;
    margin-bottom:15px;
}


.titulo p{
    color:var(--cinza);
    font-size:18px;
}


.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:30px;
}


.card{
    background:rgba(255,255,255,0.07);


    border:1px solid rgba(255,255,255,0.1);


    backdrop-filter:blur(14px);


    border-radius:28px;


    overflow:hidden;


    transition:0.4s;
}


.card:hover{
    transform:translateY(-10px);


    box-shadow:
    0 20px 40px rgba(124,58,237,0.35);
}


.card img{
    width:100%;
    height:240px;
    object-fit:cover;
}


.card-content{
    padding:30px;
}


.card-content h3{
    font-size:30px;
    margin-bottom:12px;
}


.preco{
    font-size:40px;
    font-weight:700;
    color:#c4b5fd;


    margin-bottom:5px;
}


.plano{
    color:var(--cinza);
    margin-bottom:25px;
}


.lista{
    display:flex;
    flex-direction:column;
    gap:15px;


    margin-bottom:35px;
}


.lista li{
    list-style:none;


    display:flex;
    align-items:center;
    gap:12px;


    line-height:1.6;
}


.lista i{
    color:#c084fc;
}


.botao{
    display:block;
    text-align:center;


    background:
    linear-gradient(
    135deg,
    var(--roxo),
    var(--roxo3)
    );


    padding:16px;


    border-radius:18px;


    color:white;
    text-decoration:none;


    font-weight:700;


    transition:0.3s;
}


.botao:hover{
    transform:scale(1.02);
}


/* DEPOIMENTOS */


.depoimentos{
    padding:50px 30px 100px;


    max-width:1300px;
    margin:auto;
}


.grid-depoimentos{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:30px;
}


.depoimento{
    background:rgba(255,255,255,0.07);


    border-radius:25px;


    padding:35px;


    border:1px solid rgba(255,255,255,0.1);
}


.depoimento p{
    line-height:1.9;
    color:var(--cinza);


    margin-bottom:20px;
}


.depoimento h4{
    font-size:20px;
}


.depoimento span{
    color:#c4b5fd;
}


/* CTA */


.cta{
    padding:100px 30px;


    text-align:center;


    background:
    linear-gradient(
    135deg,
    rgba(124,58,237,0.2),
    rgba(46,16,101,0.4)
    );
}


.cta h2{
    font-size:46px;
    margin-bottom:20px;
}


.cta p{
    max-width:850px;
    margin:auto;


    line-height:1.8;
    color:var(--cinza);


    margin-bottom:35px;
}


.cta a{
    display:inline-block;


    background:
    linear-gradient(
    135deg,
    var(--roxo),
    var(--roxo3)
    );


    padding:18px 35px;


    border-radius:18px;


    color:white;
    text-decoration:none;


    font-weight:700;


    transition:0.3s;
}


.cta a:hover{
    transform:translateY(-3px);
}


/* RESPONSIVO */


@media(max-width:768px){


    .hero{
        height:auto;
        padding:160px 20px 120px;
    }


    .hero h1{
        font-size:42px;
    }


    .hero p{
        font-size:17px;
    }


    .titulo h2{
        font-size:34px;
    }


    .cta h2{
        font-size:34px;
    }


}


</style>
</head>
<body>


<section class="hero">


<div class="hero-content">


<h1>
Soluções Inteligentes para sua Empresa
</h1>


<p>
A InfoGirls oferece serviços especializados em tecnologia,
infraestrutura, suporte e análise de sistemas para empresas
que desejam crescer com segurança e eficiência.
</p>


</div>


</section>


<section class="servicos">


<div class="titulo">


<h2>Nossos Serviços</h2>


<p>
Escolha o pacote ideal para sua empresa.
</p>


</div>


<div class="cards">


<!-- VISTORIA -->


<div class="card">


<img src="imagens/servico-vistoria.jpg">


<div class="card-content">


<h3>Vistoria</h3>


<div class="preco">R$ 300</div>


<div class="plano">Pacote Mensal</div>


<ul class="lista">


<li>
<i class="fa-solid fa-check"></i>
Vistoria de máquinas e equipamentos
</li>


<li>
<i class="fa-solid fa-check"></i>
Reparo de hardware
</li>


<li>
<i class="fa-solid fa-check"></i>
Atendimento presencial
</li>


<li>
<i class="fa-solid fa-check"></i>
Suporte técnico especializado
</li>


</ul>


<a href="contato.php" class="botao">
Solicitar Orçamento
</a>


</div>


</div>


<!-- ANALISE -->


<div class="card">


<img src="imagens/servico-analise.jpg">


<div class="card-content">


<h3>Análise de Sistemas</h3>


<div class="preco">R$ 900</div>


<div class="plano">Pacote Trimestral</div>


<ul class="lista">


<li>
<i class="fa-solid fa-check"></i>
Análise de sistemas operacionais
</li>


<li>
<i class="fa-solid fa-check"></i>
Diagnóstico de rede
</li>


<li>
<i class="fa-solid fa-check"></i>
Equipe especializada
</li>


<li>
<i class="fa-solid fa-check"></i>
Acesso ao pacote vistoria
</li>


</ul>


<a href="contato.php" class="botao">
Solicitar Orçamento
</a>


</div>


</div>


<!-- PREMIUM -->


<div class="card">


<img src="imagens/servico-premium.jpg">


<div class="card-content">


<h3>Premium</h3>


<div class="preco">R$ 3200</div>


<div class="plano">Pacote Anual</div>


<ul class="lista">


<li>
<i class="fa-solid fa-check"></i>
Acesso completo aos serviços
</li>


<li>
<i class="fa-solid fa-check"></i>
Contato direto com técnicos
</li>


<li>
<i class="fa-solid fa-check"></i>
Atendimento prioritário
</li>


<li>
<i class="fa-solid fa-check"></i>
Monitoramento avançado
</li>


</ul>


<a href="contato.php" class="botao">
Solicitar Orçamento
</a>


</div>


</div>


</div>


</section>


<section class="depoimentos">


<div class="titulo">


<h2>O que nossos clientes dizem</h2>


<p>
Empresas que confiam na InfoGirls.
</p>


</div>


<div class="grid-depoimentos">


<div class="depoimento">


<p>
A InfoGirls transformou nossa infraestrutura tecnológica.
O suporte é rápido, eficiente e extremamente profissional.
</p>


<h4>TechNova</h4>
<span>@technova</span>


</div>


<div class="depoimento">


<p>
Com o suporte premium conseguimos reduzir falhas internas
e melhorar toda nossa operação empresarial.
</p>


<h4>RioConnect</h4>
<span>@rioconnect</span>


</div>


<div class="depoimento">


<p>
Excelente atendimento e uma equipe extremamente preparada.
Hoje temos muito mais segurança digital.
</p>


<h4>PixelWave</h4>
<span>@pixelwave</span>


</div>


</div>


</section>


<section class="cta">


<h2>Precisa de uma solução personalizada?</h2>


<p>
Entre em contato com nossa equipe para solicitar um orçamento
personalizado para sua empresa.
</p>


<a href="contato.php">
Falar com Especialista
</a>


</section>


<?php include 'includes/footer.php'; ?>


</body>
</html>
