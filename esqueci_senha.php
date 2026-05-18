<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
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


.alerta {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #e53935;
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    z-index: 9999;
    font-weight: 600;
}


.fechar {
    margin-left: 10px;
    cursor: pointer;
    font-weight: bold;
}


@media (max-width: 500px) {
    .container {
        width: 90%;
}

    .alerta {
        right: 10px;
        left: 10px;
        font-size: 14px;
    }
}
</style>
</head>
<body>

<?php if(isset($_GET['erro'])): ?>
<div class="alerta">

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