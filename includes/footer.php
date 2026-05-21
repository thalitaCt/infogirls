<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Style+Script&display=swap');

    :root{
        --roxoEscuro:#7c3aed;
        --roxoEscuro2:#6d28d9;
        --roxoEscuro3:#5b21b6;
        --roxoEscuro4:#4c1d95;
        --roxoEscuro5:#2e1065;

        --roxoClaro:#8b5cf6;
        --roxoClaro2:#a78bfa;
        --roxoClaro3:#c4b5fd;

        --amarelo:#fde047;
        --amarelo2:#facc15;

        --branco:#ffffff;
        --preto:#333333;
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Poppins;
    }

    footer{
        margin-top:80px;

        background:
        linear-gradient(
        135deg,
        var(--roxoEscuro4),
        var(--roxoEscuro5)
        );

        color:var(--branco);

        position:relative;

        overflow:hidden;
    }

    footer::before{
        content:"";

        position:absolute;

        top:-120px;
        right:-120px;

        width:280px;
        height:280px;

        border-radius:50%;

        background:rgba(255,255,255,0.05);
    }

    footer::after{
        content:"";

        position:absolute;

        bottom:-100px;
        left:-100px;

        width:240px;
        height:240px;

        border-radius:50%;

        background:rgba(255,255,255,0.04);
    }

    .footer-container{
        position:relative;
        z-index:2;

        max-width:1400px;

        margin:auto;

        padding:70px 50px 35px;

        display:grid;
        grid-template-columns:
        1.4fr
        1fr
        1fr
        1fr;

        gap:50px;
    }

    /* LOGO */

    .footer-logo h1{
        font-family:"Style Script";
        font-size:48px;
        font-weight:400;

        color:var(--amarelo);

        margin-bottom:12px;
    }

    .footer-logo p{
        line-height:28px;

        font-size:15px;

        color:rgba(255,255,255,0.85);

        max-width:340px;
    }

    .footer-badge{
        margin-top:20px;

        display:inline-flex;
        align-items:center;
        gap:10px;

        padding:10px 18px;

        border-radius:30px;

        background:rgba(255,255,255,0.08);

        border:1px solid rgba(255,255,255,0.1);

        font-size:14px;
        font-weight:500;
    }

    .footer-badge i{
        color:var(--amarelo);
    }

    /* TITULOS */

    .footer-col h2{
        font-size:22px;

        margin-bottom:22px;

        position:relative;

        display:inline-block;
    }

    .footer-col h2::after{
        content:"";

        position:absolute;

        left:0;
        bottom:-8px;

        width:45px;
        height:4px;

        border-radius:20px;

        background:var(--amarelo2);
    }

    /* LINKS */

    .footer-links{
        display:flex;
        flex-direction:column;
        gap:14px;
    }

    .footer-links a{
        color:rgba(255,255,255,0.82);

        text-decoration:none;

        transition:0.3s;

        width:fit-content;
    }

    .footer-links a:hover{
        color:var(--amarelo);

        transform:translateX(5px);
    }

    /* CONTATO */

    .footer-info{
        display:flex;
        flex-direction:column;
        gap:18px;
    }

    .footer-info p{
        display:flex;
        align-items:flex-start;
        gap:12px;

        line-height:25px;

        color:rgba(255,255,255,0.86);

        font-size:15px;
    }

    .footer-info i{
        color:var(--amarelo);

        font-size:18px;

        margin-top:3px;
    }

    /* REDES */

    .redes{
        display:flex;
        gap:14px;

        margin-top:10px;
    }

    .redes a{
        width:52px;
        height:52px;

        border-radius:16px;

        background:rgba(255,255,255,0.08);

        border:1px solid rgba(255,255,255,0.08);

        display:flex;
        align-items:center;
        justify-content:center;

        text-decoration:none;

        transition:0.3s;
    }

    .redes a i{
        font-size:22px;

        color:var(--branco);

        transition:0.3s;
    }

    .redes a:hover{
        transform:translateY(-6px);

        background:var(--amarelo2);
    }

    .redes a:hover i{
        color:var(--roxoEscuro5);
    }

    /* FOOTER BOTTOM */

    .footer-bottom{
        position:relative;
        z-index:2;

        border-top:
        1px solid rgba(255,255,255,0.08);

        padding:22px 40px;

        text-align:center;

        color:rgba(255,255,255,0.75);

        font-size:14px;
    }

    .footer-bottom span{
        color:var(--amarelo);
        font-weight:600;
    }

    /* RESPONSIVO */

    @media (max-width: 1100px){

        .footer-container{
            grid-template-columns:
            1fr
            1fr;

            gap:45px;
        }

    }

    @media (max-width: 768px){

        .footer-container{
            grid-template-columns:1fr;

            padding:
            55px
            25px
            30px;

            gap:38px;
        }

        .footer-logo h1{
            font-size:42px;
        }

        .footer-logo p{
            max-width:100%;
        }

        .footer-col h2{
            font-size:24px;
        }

        .footer-info p{
            font-size:14px;
        }

        .redes{
            flex-wrap:wrap;
        }

        .redes a{
            width:48px;
            height:48px;
        }

        .footer-bottom{
            padding:20px;

            font-size:13px;

            line-height:24px;
        }

    }

    </style>
</head>

<body>

<footer>

    <div class="footer-container">

        <!-- LOGO -->

        <div class="footer-logo">

            <h1>InfoGirls</h1>

            <p>
                Transformamos empresas através da tecnologia,
                inovação e soluções digitais modernas para
                negócios que desejam crescer no mercado.
            </p>

            <div class="footer-badge">

                <i class="fa-solid fa-laptop-code"></i>

                Tecnologia • Inovação • Futuro

            </div>

        </div>

        <!-- LINKS -->

        <div class="footer-col">

            <h2>Navegação</h2>

            <div class="footer-links">

                <a href="index.php">
                    Home
                </a>

                <a href="sobre.php">
                    Sobre Nós
                </a>

                <a href="produtos.php">
                    Produtos
                </a>

                <a href="contato.php">
                    Contato
                </a>

            </div>

        </div>

        <!-- CONTATO -->

        <div class="footer-col">

            <h2>Contato</h2>

            <div class="footer-info">

                <p>

                    <i class="fa-solid fa-envelope"></i>

                    infogirlsfive1@gmail.com

                </p>

                <p>

                    <i class="fa-solid fa-phone"></i>

                    +55 (21) 99999-9999

                </p>

                <p>

                    <i class="fa-solid fa-location-dot"></i>

                    Av. Mal. Floriano, 63
                    Centro - Rio de Janeiro/RJ

                </p>

            </div>

        </div>

        <!-- REDES -->

        <div class="footer-col">

            <h2>Redes Sociais</h2>

            <div class="redes">

                <a href="https://www.facebook.com/share/17J9R8JPmK/"
                target="_blank">

                    <i class="fa-brands fa-facebook-f"></i>

                </a>

                <a href="https://www.instagram.com/infogirls__?igsh="
                target="_blank">

                    <i class="fa-brands fa-instagram"></i>

                </a>

                <a href="https://x.com/Infogirlsfive"
                target="_blank">

                    <i class="fa-brands fa-x-twitter"></i>

                </a>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        © 2026 <span>InfoGirls</span>.
        Todos os direitos reservados.

    </div>

</footer>

</body>
</html>
