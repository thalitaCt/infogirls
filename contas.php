<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleContas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Cadastro/Login</title>
</head>
<body>

<?php if(isset($_GET['msg'])): ?>
<div class="alerta-sucesso">
<?php
if ($_GET['msg'] == 'email_enviado') echo "Email enviado!<br>Verifique sua caixa de entrada";
if ($_GET['msg'] == 'senha_alterada') echo "Senha alterada com sucesso";
if ($_GET['msg'] == 'verificado') echo "Conta verificada com sucesso! <br>Faça login";
?>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
<div class="alerta">
<?php
if ($_GET['erro'] == 'email') echo "Email não encontrado";
if ($_GET['erro'] == 'senha') echo "Senha incorreta";
if ($_GET['erro'] == 'email_existente') echo "E-mail já cadastrado";
if ($_GET['erro'] == 'cpf_cnpj') echo "CPF ou CNPJ já cadastrado";
if ($_GET['erro'] == 'geral') echo "Erro ao cadastrar";
if ($_GET['erro'] == 'login') echo "Faça login ou crie uma conta para comprar produtos";
if ($_GET['erro'] == 'nao_verificado') echo "Verifique seu email antes de entrar";
?>
<span class="fechar" onclick="this.parentElement.style.display='none'">X</span>
</div>
<?php endif; ?>

    <div class="container">

<div class="form-box login">

    <form action="actions/processa_login.php" method="POST">
            <h2 class="titulo">Login</h2>

        <div class="input-box"><input type="email" name="email" placeholder="Email" required></div>
        <div class="input-box"><input type="password" name="senha" placeholder="Senha" required></div>
        <p id="link-senha"><a href="esqueci_senha.php">Esqueceu a senha?</a></p>
        <button type="submit">Logar</button><br>
    </form>
</div>

<div class="form-box cadastro">

    <form action="actions/processa_cadastro.php" method="POST">
            <h2 class="titulo">Cadastrar</h2>

        <div class="input-box"><input type="text" name="nome" placeholder="Nome" required></div>
        <div class="input-box"><input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF ou CNPJ" maxlength="18" required></div>
        <div class="input-box"><input type="text" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" required></div>
        <div class="input-box"><input type="email" name="email" placeholder="E-mail" required></div>
        <div class="input-box"><input type="text" name="endereco" placeholder="Endereço" required></div>
        <div class="input-box"><input type="password" name="senha" placeholder="Senha" required></div>
        <button type="submit">Cadastrar</button>
    </form>
</div>

    <div class="toggle-box">
        <div class="toggle esquerda">
            <h1>Olá, bem-vindo(a)!</h1>
            <p>Não tem uma conta?</p>
            <button class="btn btn-cadastro">Registrar-se</button>
        </div>

        <div class="toggle direita">
            <h1>Bem-vindo(a) de volta!</h1>
            <p>Já tem uma conta?</p>
            <button class="btn btn-login">Login</button>
        </div>

    </div>

</div>

    <script>
const doc = document.getElementById('cpf_cnpj');

doc.addEventListener('input', function () {

    let valor = this.value.replace(/\D/g, '');

    if (valor.length <= 11) {

        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    } else {

        valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    }

    this.value = valor;
});
</script>

        <script>
        document.getElementById('telefone').addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g,'');

        if (v.length > 11) v = v.slice(0, 11);

        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d{5})(\d{4})$/,"$1-$2");

        e.target.value = v;
});

    </script>

    <script src="js/contas.js"> </script>
</body>
</html>