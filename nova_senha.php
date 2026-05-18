<?php
    include 'includes/conexao.php';

    $token = $_GET['token'];

    $sql = "SELECT * FROM clientes WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['token' => $token]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || strtotime($usuario['token_expira']) <time()) {
        die("Token inválido ou expirado");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
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
    background:var(--roxoClaro2);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}


.container {
    background:var(--roxoClaro);
    padding:30px;
    border-radius:20px;
    width:90%;
    max-width:420px;
    color:white;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}


h2 {
    margin-bottom:20px;
}


input {
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:10px;
    outline:none;
}


button {
    width:100%;
    margin-top:15px;
    padding:12px;
    border:none;
    border-radius:10px;
    background:var(--roxoClaro2);
    color:var(--roxoEscuro3);
    font-weight:700;
    cursor:pointer;
}


button:disabled {
    opacity:0.5;
    cursor:not-allowed;
}


small {
    display:block;
    margin-top:6px;
    font-weight:600;
}


.senha-box {
    position: relative;
    width: 100%;
    margin-top: 10px;
}


/* input normal */
.senha-box input {
    width: 100%;
    padding: 12px 40px 12px 12px;
    box-sizing: border-box;
}


.olho {
    position: absolute;
    padding-top: 8px;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    
    display: flex;
    align-items: center;
    justify-content: center;


    height: 100%;
    cursor: pointer;
    color: gray;
    font-size: 16px;
    user-select: none;
}


.olho:hover {
    opacity: 1;
    transform: translateY(-50%) scale(1.1);
}
</style>
</head>

<body>

<div class="container">

<h2>Nova Senha</h2>

<?php if(isset($_GET['erro']) && $_GET['erro'] == 'senha_diferente'): ?>
    <p style="color:yellow; font-weight:600;">
        As senhas não coincidem
    </p>
<?php endif; ?>

<form action="actions/processa_nova_senha.php" method="POST">

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <div class="senha-box">
    <input type="password" id="senha" name="senha" placeholder="Nova senha" required>
    <i class="fa-solid fa-eye olho" onclick="toggleSenha('senha', this)"></i>
</div>

<div class="senha-box">
    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirmar senha" required>
    <i class="fa-solid fa-eye olho" onclick="toggleSenha('confirmar_senha', this)"></i>
</div>
    <small id="msgSenha"></small>

    <button type="submit" id="btn">Alterar senha</button>

</form>
</div>


<script>
const senha = document.getElementById('senha');
const confirmar = document.getElementById('confirmar_senha');
const msg = document.getElementById('msgSenha');
const btn = document.getElementById('btn');


function validar() {

    if (!senha.value || !confirmar.value) {
        msg.textContent = "";
        btn.disabled = false;
        return;
    }

    if (senha.value === confirmar.value) {
        msg.textContent = "✔ Senhas coincidem";
        msg.style.color = "green";
        btn.disabled = false;
    } else {
        msg.textContent = "✖ Senhas não coincidem";
        msg.style.color = "red";
        btn.disabled = true;
    }
}

senha.addEventListener('input', validar);
confirmar.addEventListener('input', validar);
</script>

<script>
function toggleSenha(id, icon) {
    const input = document.getElementById(id);


    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
    
</body>
</html>
