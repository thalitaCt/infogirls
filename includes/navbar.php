<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
</head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Style+Script&display=swap');

            :root {
                --roxoEscuro: #7c3aed;
                --roxoEscuro2: #6d28d9;
                --roxoEscuro3: #5b21b6;
                --roxoEscuro4: #4c1d95;
                --roxoEscuro5: #2e1065;
                --branco: #ffffff;
                --preto: #333333;
                --roxoClaro: #8b5cf6;
                --roxoClaro2: #a78bfa;
                --roxoClaro3: #c4b5fd;
                --amarelo: #fde047;
                --amarelo2: #facc15;
            }

            * {
                font-family: Poppins;
                margin: 0px;
                padding: 0px;
            }

            body {
                color: var(--branco);
            }

            .navbar {
                background-color: var(--roxoEscuro3);
                display: grid;
                grid-template-columns: 1fr auto 1fr;
                padding: 0 30px;
                align-items: center;
                position: fixed;
                left: 0px;
                right:0px;
                top: 0px;
                z-index: 1000;
                height: 40px;

                .carrinho-icon {
                    position: relative;
                    display: inline-block;
                    margin-top: 13px;

                    #numeroC {
                    position:absolute;
                    top: -18px;
                    right: -19px;
                    background-color: red;
                    color: var(--branco);
                    font-weight: 500;
                    font-size: 12pt;
                    border-radius: 8px;
                    padding: 2px;
                    }

}
            }

            .logo {
                justify-self: flex-start;
            }

            .navbar .menu ul {
                list-style: none;
                display: flex;
                gap: 30px;
                transition: 0.5s;
            }

            .navbar .menu a {
                color: var(--branco);
                text-decoration: none;
                transition: 0.5s;
            }

            .navbar .menu ul li {
                transition: 0.5s
            }

            .menu {
                display: flex;
                justify-self: center;
                gap: 10px;
            }

            .navbar .menu ul li:hover {
                transform: scale(1.1);
                background-color: var(--amarelo2);
                border-radius: 20px;
                padding: 8px;
                font-weight: 700;
            }

            .navbar .menu a:hover {
                color: var(--roxoEscuro2);
            }

            .navbar .icons a {
                color: var(--branco);
                text-decoration: none;
                padding-left: 25px;
                transition: 0.5s;
            }

            .navbar .icons a:hover {
                color: var(--amarelo2);
            }

            .icons i {
                transition: 0.5s;
            }

            .icons i:hover {
                transform: scale(1.3);
            }

            .icons {
                margin-left: 40px;
                justify-self: end;
                display: flex;
                gap: 20px;
                font-size: 15pt;
            }

            .user-icon {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;

                i {
                    margin-top: 18px;
                }

                span {
                    font-size: 9pt;
                    margin-left: 17px;
                }
            }

            .menu-icon {
                display: none;
            }

            @media (max-width: 768px) {

            .menu a{
                color:white;
                text-decoration:none;
            }
            .menu-icon{
                display:none;
                font-size:30px;
                cursor:pointer;
            }


                .menu{
                    text-align: center;
                    display:none;
                    flex-direction:column;
                    background:var(--roxoEscuro3);
                    position:absolute;
                    top:60px;
                    right:0;
                    width:200px;
                    padding:10px;
                    border-radius: 15px;
                    gap: 30px;
                }

                .menu ul {
                    text-align: center;
                    flex-direction: column;
                }

                .icons {
                    flex-direction: column;
                    text-align: center;
                    margin-right: 20px;
                }


                .menu.active{
                    display:flex;
                    flex-direction: column;
                }


                .menu-icon{
                    display:block;
                }

                .carrinho-icon {
                    #numeroC {
                        margin-right: 65px;
                        padding: 3px;
                        margin-top: 11px;
                        font-size: 6pt;
                    }
                }

               
            }

    </style>
<body>
    <header class="navbar">
        
        <div class="logo">InfoGirls</div>

<?php
  $totalItens = 0;

  if(isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $item) {
        $totalItens += $item['quantidade'] ?? 1;
    }
  }
?>

<div class="menu-icon" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></div>

            <div class="menu" id="menu"><ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="pedidos.php">Pedidos</a></li>
            </ul>

            <div class="icons">

                <div class="carrinho-icon">
                    <a href="carrinho.php"> <i class="fa-solid fa-cart-shopping"></i> </a>
                    <span id="numeroC"><?php echo $totalItens; ?></span> 
                </div>

                <div class="user-icon">
                    <?php if(isset($_SESSION['nome'])): ?>
                        <a href="logout.php" title="Sair"> <i class="fa-solid fa-user"></i></a>

                            <?php
                            $nome = $_SESSION['nome'];
                            $partes = explode(" ", trim($nome));
                            $primeiro = $partes[0];
                            $segundo = $partes[1];
                            $nomeFormatado = $primeiro . "  " . $segundo;
                            ?>

                        <span class="nome-user"><?= $nomeFormatado?></span>

                        <?php else: ?>
                            <a href="contas.php"> <i class="fa-solid fa-user"></i></a>

                            <?php endif; ?>
                </div>
                </div>
            </div>
        
    </header>

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("active");
        }
        </script>
</body>
</html>
