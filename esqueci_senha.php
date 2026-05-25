<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Style+Script&display=swap');

:root{
        --roxoEscuro:#8b77c6;
        --roxoEscuro2:#7660b3;
        --roxoEscuro3:#584194;
        --roxoEscuro4:#4a347f;
        --roxoEscuro5:#2d1d52;

        --roxoClaro:#8b5cf6;
        --roxoClaro2:#a78bfa;
        --roxoClaro3:#c4b5fd;

        --amarelo:#fde047;
        --amarelo2:#facc15;

        --branco:#ffffff;
        --preto:#333333;
    }

* {
    font-family: Poppins;
    margin: 0px;
    padding: 0px;
}
body {
    background: var(--roxoClaro3);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}


.container {
    background: var(--roxoEscuro);
    padding: 30px;
    border-radius: 20px;
    width: 100%;
    max-width: 420px;
    color: white;
}


h2 {
    margin-bottom: 20px;
}


input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    outline: none;
    margin-top: 10px;
}


button {
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: var(--roxoClaro2);
    color: var(--roxoEscuro3);
    font-weight: 700;
    cursor: pointer;
}


button:hover {
    background: var(--roxoClaro3);
}


.alerta{
    position:fixed;

    top:25px;
    right:25px;

    padding:18px 22px;

    border-radius:16px;

    display:flex;
    align-items:center;
    gap:15px;

    z-index:9999;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.25);

    font-weight:600;

    animation:aparecer 0.3s ease;
}

.sucesso{
    background:#22c55e;
    color:white;
}

.erro{
    background:#ef4444;
    color:white;
}

.fechar{
    cursor:pointer;
    margin-left:10px;
}

@keyframes aparecer{

    from{
        opacity:0;
        transform:translateY(-10px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}


@media (max-width: 500px) {
    .container {
        width: 90%;
}

    .alerta{
        left:15px;
        right:15px;

        top:15px;

        font-size:14px;
    }
}
</style>
</head>
<body>

<?php if(isset($_GET['erro'])): ?>
<div class="alerta erro">

<i class="fa-solid fa-triangle-exclamation"></i>

<?php
if($_GET['erro'] === 'email') {
    echo "E-mail não encontrado.";
} else {
    echo "Erro ao processar solicitação.";
}
?>

<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>


<div class="container">

    <h2>Esqueci minha senha</h2>

    <form action="actions/processa_esqueci.php" method="POST">

        <input 
            type="email" 
            name="email" 
            placeholder="Digite seu email"
            required
        >
        <button type="submit">Enviar link</button>

</form>

</div>

</body>
</html>