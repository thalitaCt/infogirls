<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Navbar</title>


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


    body{
        overflow-x:hidden;
    }

    html, body {
  overflow-x: hidden;
    }

    /* NAVBAR */


    .navbar{
        position:fixed;
        top:0;
        left:0;
        right:0;


        z-index:9999;


        height:95px;

        box-sizing: border-box;
        background:linear-gradient(
        90deg,
        var(--roxoEscuro4),
        var(--roxoEscuro3)
        );


        display:flex;
        align-items:center;
        justify-content:space-between;


        padding:0 35px;


        box-shadow:0 5px 20px rgba(0,0,0,0.18);
    }


    /* LOGO */


    .logo{
        display:flex;
        align-items:center;
        gap:12px;


        text-decoration:none;
        color:var(--branco);
    }


    .logo-circle{
        width:55px;
        height:55px;


        border-radius:50%;


        background:linear-gradient(
        135deg,
        var(--amarelo),
        var(--amarelo2)
        );


        display:flex;
        align-items:center;
        justify-content:center;


        color:var(--roxoEscuro5);


        font-size:24px;
    }


    .logo-text{
        display:flex;
        flex-direction:column;
        line-height:1;
    }


    .logo-text h1{
        font-family:"Style Script";
        font-size:34px;
        font-weight:400;
    }


    .logo-text span{
        font-size:11px;
        letter-spacing:2px;
        opacity:0.9;
    }


    /* MENU */


    .menu{
        display:flex;
        align-items:center;
    }


    .menu ul{
        list-style:none;


        display:flex;
        align-items:center;
        gap:28px;
    }


    .menu a{
        text-decoration:none;
        color:var(--branco);


        font-size:15px;
        font-weight:500;


        transition:0.3s;
    }


    .menu li{
        transition:0.3s;


        padding:10px 14px;
        border-radius:14px;
    }


    .menu li:hover{
        background:rgba(255,255,255,0.12);
        transform:translateY(-2px);
    }


    .menu a:hover{
        color:var(--amarelo);
    }


    /* ICONS */


    .icons{
        display:flex;
        align-items:center;
        gap:22px;
    }


    .icons a{
        text-decoration:none;
        color:var(--branco);
    }


    /* CARRINHO */


    .carrinho-icon{
        position:relative;
    }


    .carrinho-icon i{
        font-size:24px;
        transition:0.3s;
    }


    .carrinho-icon i:hover{
        color:var(--amarelo);
        transform:scale(1.15);
    }


    #numeroC{
        position:absolute;


        top:-10px;
        right:-12px;


        min-width:22px;
        height:22px;


        border-radius:50%;


        background:var(--amarelo2);
        color:var(--roxoEscuro5);


        display:flex;
        align-items:center;
        justify-content:center;


        font-size:11px;
        font-weight:700;


        padding:2px;
    }


    /* USER MENU */


    .user-menu{
        position:relative;
    }


    .user-button{
        background:none;
        border:none;


        color:var(--branco);


        display:flex;
        align-items:center;
        gap:10px;


        cursor:pointer;


        font-size:15px;
        font-weight:500;
    }


    .user-button i{
        transition:0.3s;
    }


    .user-button:hover i{
        color:var(--amarelo);
    }


    .user-avatar{
        width:42px;
        height:42px;


        border-radius:50%;


        background:rgba(255,255,255,0.12);


        display:flex;
        align-items:center;
        justify-content:center;


        font-size:18px;
    }


    .seta{
        font-size:11px !important;
    }


    /* DROPDOWN */


    .dropdown-user{
        position:absolute;


        top:60px;
        right:0;


        width:220px;


        background:var(--branco);


        border-radius:18px;


        overflow:hidden;


        box-shadow:0 10px 25px rgba(0,0,0,0.18);


        display:none;


        flex-direction:column;
    }


    .dropdown-user.active{
        display:flex;
    }


    .dropdown-user a{
        padding:16px 18px;


        color:var(--preto) !important;


        font-size:15px;
        font-weight:500;


        transition:0.3s;
    }


    .dropdown-user a:hover{
        background:#f5f3ff;
        color:var(--roxoEscuro3) !important;
    }


    /* MOBILE USER */


    .mobile-user{
        display:none;
    }


    /* MENU ICON */


    .menu-icon{
        display:none;


        color:var(--branco);


        font-size:28px;


        cursor:pointer;
    }


    /* RESPONSIVO */

@media (max-width: 768px) {

  .navbar {
    padding: 12px 15px;
    height: 75px;
    gap: 10px;
  }

  /* LOGO SEM SUMIR */
  .logo {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .logo-text h1 {
    font-size: 22px;
  }

  .logo-text span {
    font-size: 9px;
  }

  /* ICONS */
  .icons {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 15px;
  }

  /* MENU ICON SEM EMPURRAR LAYOUT */
  .menu-icon {
    display: block;
    font-size: 28px;
    margin-left: 10px;
  }

  /* CARRINHO AJUSTADO */
  .carrinho-icon {
    position: relative;
  }

  #numeroC {
    top: -8px;
    right: -8px;
  }

  /* REMOVE BUG DE OVERFLOW FORÇADO */
  .navbar * {
    max-width: unset;
  }
}

    </style>
</head>


<body>


<?php
$totalItens = 0;


if(isset($_SESSION['carrinho'])){


    foreach($_SESSION['carrinho'] as $item){


        $totalItens += $item['quantidade'] ?? 1;


    }


}
?>


<header class="navbar">


    <!-- LOGO -->


    <a href="index.php" class="logo">


        <div class="logo-circle">
            <i class="fa-solid fa-laptop-code"></i>
        </div>


        <div class="logo-text">
            <h1>InfoGirls</h1>
            <span>TECH STORE</span>
        </div>


    </a>


    <!-- MENU MOBILE -->


    <div class="menu-icon" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
    </div>


    <!-- MENU -->


    <nav class="menu" id="menu">


        <ul>


            <li>
                <a href="index.php">Home</a>
            </li>


            <li>
                <a href="produtos.php">Produtos</a>
            </li>


            <li>
                <a href="sobre.php">Sobre</a>
            </li>


            <li>
                <a href="contato.php">Contato</a>
            </li>


            <?php if(isset($_SESSION['usuario'])): ?>


            <li>
                <a href="pedidos.php">Pedidos</a>
            </li>


            <?php endif; ?>


            <!-- MOBILE -->


            <div class="mobile-user">


            <?php if(isset($_SESSION['nome'])): ?>


            <?php


            $nome = trim($_SESSION['nome']);
            $partes = explode(" ", $nome);


            $primeiro = $partes[0];


            ?>


            <span>
                Olá, <?= $primeiro; ?>
            </span>


            <li>
                <a href="minha_conta.php">Minha Conta</a>
            </li>


            <li>
                <a href="pedidos.php">Meus Pedidos</a>
            </li>


            <li>
                <a href="logout.php">Sair</a>
            </li>


            <?php else: ?>


            <li>
                <a href="contas.php">Entrar / Criar Conta</a>
            </li>


            <?php endif; ?>


            </div>


        </ul>


    </nav>


    <!-- ICONS -->


    <div class="icons">


        <!-- CARRINHO -->


        <div class="carrinho-icon">


            <a href="carrinho.php">


                <i class="fa-solid fa-cart-shopping"></i>


            </a>


            <span id="numeroC">
                <?= $totalItens; ?>
            </span>


        </div>


        <!-- USER -->


        <div class="user-menu">


        <?php if(isset($_SESSION['nome'])): ?>


        <?php


        $nome = trim($_SESSION['nome']);
        $partes = explode(" ", $nome);


        $primeiro = $partes[0];


        ?>


        <button class="user-button"
        onclick="toggleDropdown()">


            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>


            <span>
                <?= $primeiro; ?>
            </span>


            <i class="fa-solid fa-chevron-down seta"></i>


        </button>


        <div class="dropdown-user"
        id="dropdownUser">


            <a href="minha_conta.php">


                <i class="fa-solid fa-user"></i>
                Minha Conta


            </a>


            <a href="pedidos.php">


                <i class="fa-solid fa-box"></i>
                Meus Pedidos


            </a>


            <a href="logout.php">


                <i class="fa-solid fa-right-from-bracket"></i>
                Sair


            </a>


        </div>


        <?php else: ?>


        <a href="contas.php">


            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>


        </a>


        <?php endif; ?>


        </div>


    </div>


</header>


<script>


function toggleMenu(){


    document
    .getElementById("menu")
    .classList.toggle("active");


}


function toggleDropdown(){


    document
    .getElementById("dropdownUser")
    .classList.toggle("active");


}


/* FECHAR DROPDOWN */


window.addEventListener("click", function(e){


    const dropdown = document.getElementById("dropdownUser");


    const button = document.querySelector(".user-button");


    if(dropdown && button){


        if(
            !dropdown.contains(e.target)
            &&
            !button.contains(e.target)
        ){


            dropdown.classList.remove("active");


        }


    }


});


</script>


</body>
</html>
