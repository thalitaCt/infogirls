<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <style>
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

        body {
            font-family: Poppins;
        }
        
        footer {
            margin-top: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 70px;
            font-size: 11pt;
            background-color: var(--roxoClaro);
            color: var(--roxoEscuro3);
            padding: 30px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            text-align: start;
        }

        .redes i {
            font-size: 22pt;
            padding-right: 10px;
            color: var(--roxoEscuro3);
        }

        @media (max-width: 768px) {
            footer {
                display: block;
                bottom: 0px;
            }

            .nome {
                padding-bottom: 10px;
                h1 {
                    font-size: 22pt;
                }
                p {
                    font-size: 10pt;
                }
            }

            .contato {
                padding-bottom: 10px;

                h1 {
                    font-size: 22pt;
                }
                p {
                    font-size: 10pt;
                }
            }

            .redes {
                padding-bottom: 18px;

                h1 {
                    font-size: 22pt;
                }
                i {
                    padding-right: 7px;
                }
            }

            .copy {
                font-size: 9pt;
            }
        }
    </style>
</head>
<body>
    <footer>

        <div class="nome">
            <h1>InfoGirls</h1>
            <p>Soluções em tecnologia e <br>Informatização de empresas</p>
        </div>

            <div class="contato">
                <h1>Contato</h1>
                <p>Email: infogirlsfive1@gmail.com<br>                                                                                       
                Local: Av. Mal. Floriano, 63 Centro, <br>Rio de Janeiro - RJ 20080-002</p>
            </div>

                <div class="redes">
                    <h1>Redes Sociais</h1>
                    <a href="https://www.facebook.com/share/17J9R8JPmK/"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/infogirls__?igsh="><i class="fa-brands fa-square-instagram"></i></a>
                    <a href="https://x.com/Infogirlsfive"><i class="fa-brands fa-square-x-twitter"></i></a>
                </div>

            <div class="copy">
                @ 2026 InfoGirls. Todos os direitos reservados
            </div>
        </footer>
</body>
</html>