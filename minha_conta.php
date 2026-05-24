<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: contas.php?erro=login");
    exit;
}

include 'includes/conexao.php';
include 'includes/navbar.php';

$idUsuario = $_SESSION['id'];

$sql = $pdo->prepare("
SELECT 
    u.email,

    COALESCE(c.nome, f.nome) AS nome,
    COALESCE(c.telefone, f.telefone) AS telefone,

    c.cep,
    c.endereco,
    c.numero,
    c.bairro,
    c.cidade,
    c.estado,
    c.regiao

FROM usuarios u

LEFT JOIN clientes c
ON c.usuario_id = u.id_usuario

LEFT JOIN funcionarios f
ON f.usuario_id = u.id_usuario

WHERE u.id_usuario = ?
");

$sql->execute([$idUsuario]);

$cliente = $sql->fetch(PDO::FETCH_ASSOC);

if(!$cliente){

    $cliente = [
        'nome' => '',
        'telefone' => '',
        'email' => '',
        'cep' => '',
        'endereco' => '',
        'numero' => '',
        'bairro' => '',
        'cidade' => '',
        'estado' => '',
        'regiao' => ''
    ];
}

$primeiroNome = '';

if(!empty($cliente['nome'])){

    $primeiroNome =
    explode(" ", trim($cliente['nome']))[0];

}

$inicial = 'U';

if($primeiroNome != ''){

    $inicial =
    strtoupper(substr($primeiroNome, 0, 1));

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Minha Conta</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root{
    --roxoEscuro:#7c3aed;
    --roxoEscuro2:#6d28d9;
    --roxoEscuro3:#5b21b6;
    --roxoEscuro4:#4c1d95;
    --roxoEscuro5:#2e1065;

    --roxoClaro:#8b5cf6;
    --roxoClaro2:#a78bfa;
    --roxoClaro3:#ddd6fe;

    --branco:#ffffff;
    --preto:#333333;

    --verde:#16a34a;
    --verdeBg:#dcfce7;

    --vermelho:#dc2626;
    --vermelhoBg:#fee2e2;

    --cinza:#6b7280;
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
    #f5f3ff 0%,
    #ede9fe 100%
    );

    min-height:100vh;
    padding-top:120px;
}

.container{
    width:100%;
    max-width:1300px;
    margin:auto;
    padding:25px;
}

.topo{
    margin-bottom:35px;
}

.topo h1{
    color:var(--roxoEscuro5);
    font-size:42px;
    margin-bottom:10px;
}

.topo p{
    color:var(--cinza);
    font-size:16px;
}

.grid{
    display:grid;
    grid-template-columns:320px 1fr;
    gap:25px;
    align-items:start;
}

/* SIDEBAR */

.sidebar{
    background:rgba(255,255,255,0.85);
    border:1px solid rgba(124,58,237,0.12);
    backdrop-filter:blur(12px);

    border-radius:28px;
    padding:35px 25px;

    box-shadow:
    0 10px 30px rgba(124,58,237,0.08);
}

.avatar{
    width:110px;
    height:110px;

    border-radius:50%;

    background:
    linear-gradient(
    135deg,
    var(--roxoEscuro),
    var(--roxoEscuro3)
    );

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    margin:auto;

    font-size:42px;
    font-weight:700;

    margin-bottom:20px;
}

.sidebar h2{
    text-align:center;
    color:var(--roxoEscuro5);
    margin-bottom:8px;
}

.email{
    text-align:center;
    color:var(--cinza);
    font-size:14px;
    word-break:break-word;
}

.badge{
    width:max-content;
    margin:20px auto 30px;

    background:var(--verdeBg);
    color:var(--verde);

    padding:8px 15px;
    border-radius:30px;

    font-size:13px;
    font-weight:600;
}

.info-box{
    background:#f5f3ff;
    border-radius:18px;
    padding:18px;
    margin-top:15px;
}

.info-box h4{
    color:var(--roxoEscuro4);
    margin-bottom:10px;

    display:flex;
    align-items:center;
    gap:10px;
}

.info-box p{
    color:var(--cinza);
    line-height:1.6;
    font-size:14px;
}

/* FORM */

.form-area{
    display:flex;
    flex-direction:column;
    gap:25px;
}

.card{
    background:rgba(255,255,255,0.88);
    border-radius:28px;

    padding:35px;

    border:1px solid rgba(124,58,237,0.12);

    box-shadow:
    0 10px 30px rgba(124,58,237,0.08);
}

.card h2{
    color:var(--roxoEscuro5);

    margin-bottom:30px;

    display:flex;
    align-items:center;
    gap:12px;

    font-size:28px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:22px;
}

.full{
    grid-column:1/-1;
}

.input-group{
    display:flex;
    flex-direction:column;
}

.input-group label{
    color:var(--roxoEscuro4);
    margin-bottom:10px;
    font-weight:600;
}

.input-group input,
.input-group select{
    padding:16px;
    border-radius:16px;

    border:2px solid var(--roxoClaro3);

    background:#f5f3ff;

    outline:none;

    font-size:15px;

    transition:0.3s;
}

.input-group input:focus,
.input-group select:focus{
    border-color:var(--roxoEscuro);

    box-shadow:
    0 0 0 4px rgba(124,58,237,0.15);
}

.input-group small{
    margin-top:8px;
    color:var(--cinza);
    font-size:13px;
}

.botao{
    margin-top:10px;

    border:none;

    background:
    linear-gradient(
    135deg,
    var(--roxoEscuro),
    var(--roxoEscuro3)
    );

    color:white;

    padding:18px;

    border-radius:18px;

    font-size:17px;
    font-weight:700;

    cursor:pointer;

    transition:0.3s;
}

.botao:hover{
    transform:translateY(-2px);

    box-shadow:
    0 10px 20px rgba(124,58,237,0.25);
}

/* ALERTAS */

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
/* RESPONSIVO */

@media(max-width:950px){

    .grid{
        grid-template-columns:1fr;
    }

    .sidebar{
        order:2;
    }

    .form-area{
        order:1;
    }

}

@media(max-width:768px){

    body{
        padding-top:100px;
    }

    .container{
        padding:15px;
    }

    .topo h1{
        font-size:32px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .card{
        padding:25px;
    }

    .card h2{
        font-size:24px;
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

if($_GET['erro'] == 'nome_vazio'){
    echo "Preencha o nome.";
}

elseif($_GET['erro'] == 'telefone_vazio'){
    echo "Preencha o telefone.";
}

elseif($_GET['erro'] == 'telefone_invalido'){
    echo "Telefone inválido.";
}

elseif($_GET['erro'] == 'cep_invalido'){
    echo "CEP inválido.";
}

else{
    echo "Ocorreu um erro inesperado.";
}

?>

<span class="fechar"
onclick="this.parentElement.style.display='none'">
X
</span>

</div>

<?php endif; ?>

<?php if(isset($_GET['msg'])): ?>

<div class="alerta sucesso">

<i class="fa-solid fa-circle-check"></i>

<?php

if($_GET['msg'] == 'salvo'){
    echo "Dados atualizados com sucesso!";
}

else{
    echo "Operação realizada com sucesso!";
}

?>

<span class="fechar"
onclick="this.parentElement.style.display='none'">
X
</span>

</div>

<?php endif; ?>

<div class="container">

<div class="topo">

<h1>Minha Conta</h1>

<p>
Gerencie suas informações pessoais e endereço de entrega.
</p>

</div>

<form action="actions/salvar_conta.php" method="POST">

<div class="grid">

<!-- SIDEBAR -->

<div class="sidebar">

<div class="avatar">
<?= $inicial ?>
</div>

<h2><?= htmlspecialchars($cliente['nome']) ?></h2>

<p class="email">
<?= htmlspecialchars($cliente['email']) ?>
</p>

<div class="badge">
<i class="fa-solid fa-circle-check"></i>
Conta ativa
</div>

<div class="info-box">

<h4>
<i class="fa-solid fa-shield-halved"></i>
Segurança
</h4>

<p>
Seus dados são utilizados para pedidos,
entregas e suporte da plataforma.
</p>

</div>

<div class="info-box">

<h4>
<i class="fa-solid fa-truck-fast"></i>
Entrega
</h4>

<p>
Seu endereço salvo será utilizado
automaticamente durante o checkout.
</p>

</div>

</div>

<!-- FORMULÁRIOS -->

<div class="form-area">

<!-- DADOS -->

<div class="card">

<h2>
<i class="fa-solid fa-user-gear"></i>
Dados Pessoais
</h2>

<div class="form-grid">

<div class="input-group">

<label>Nome completo</label>

<input
type="text"
name="nome"
required
value="<?= htmlspecialchars($cliente['nome']) ?>">

</div>

<div class="input-group">

<label>Telefone</label>

<input
type="text"
name="telefone"
id="telefone"
maxlength="15"
required
value="<?= htmlspecialchars($cliente['telefone']) ?>">

</div>

<div class="input-group full">

<label>Email</label>

<input
type="email"
disabled
value="<?= htmlspecialchars($cliente['email']) ?>">

</div>

</div>

</div>

<!-- ENDEREÇO -->

<div class="card">

<h2>
<i class="fa-solid fa-location-crosshairs"></i>
Endereço de Entrega
</h2>

<div class="form-grid">

<div class="input-group">

<label>CEP</label>

<input
type="text"
name="cep"
id="cep"
maxlength="9"
value="<?= htmlspecialchars($cliente['cep'] ?? '') ?>">

</div>

<div class="input-group">

<label>Número</label>

<input
type="text"
name="numero"
value="<?= htmlspecialchars($cliente['numero'] ?? '') ?>">

</div>

<div class="input-group full">

<label>Rua / Avenida</label>

<input
type="text"
name="endereco"
value="<?= htmlspecialchars($cliente['endereco'] ?? '') ?>">

</div>

<div class="input-group">

<label>Bairro</label>

<input
type="text"
name="bairro"
value="<?= htmlspecialchars($cliente['bairro'] ?? '') ?>">

</div>

<div class="input-group">

<label>Cidade</label>

<input
type="text"
name="cidade"
value="<?= htmlspecialchars($cliente['cidade'] ?? '') ?>">

</div>

<div class="input-group">

<label>Estado</label>

<select name="estado" id="estado">

<option value="">Selecione</option>

<?php

$estados = [
"AC"=>"Acre",
"AL"=>"Alagoas",
"AP"=>"Amapá",
"AM"=>"Amazonas",
"BA"=>"Bahia",
"CE"=>"Ceará",
"DF"=>"Distrito Federal",
"ES"=>"Espírito Santo",
"GO"=>"Goiás",
"MA"=>"Maranhão",
"MT"=>"Mato Grosso",
"MS"=>"Mato Grosso do Sul",
"MG"=>"Minas Gerais",
"PA"=>"Pará",
"PB"=>"Paraíba",
"PR"=>"Paraná",
"PE"=>"Pernambuco",
"PI"=>"Piauí",
"RJ"=>"Rio de Janeiro",
"RN"=>"Rio Grande do Norte",
"RS"=>"Rio Grande do Sul",
"RO"=>"Rondônia",
"RR"=>"Roraima",
"SC"=>"Santa Catarina",
"SP"=>"São Paulo",
"SE"=>"Sergipe",
"TO"=>"Tocantins"
];

foreach($estados as $sigla => $nome){

$selected =
(($cliente['estado'] ?? '') === $sigla)
? 'selected'
: '';

echo "
<option value='$sigla' $selected>
$nome ($sigla)
</option>
";
}

?>

</select>

</div>

<div class="input-group full">

<label>Região de entrega</label>

<select name="regiao" id="regiao">

<option value="">Selecione</option>

<?php

$regioes = [
"Centro",
"Zona Sul",
"Zona Norte",
"Zona Oeste",
"Zona Sudoeste",
"Entrega Externa"
];

foreach($regioes as $r){

$selected =
(($cliente['regiao'] ?? '') === $r)
? 'selected'
: '';

echo "
<option value='$r' $selected>
$r
</option>
";
}

?>

</select>

<small>
Utilizado para cálculo de frete da loja.
</small>

</div>

</div>

<button type="submit" class="botao">
<i class="fa-solid fa-floppy-disk"></i>
Salvar Alterações
</button>

</div>

</div>

</div>

</form>

</div>

<?php include 'includes/footer.php'; ?>

<script>

document.getElementById('telefone')
.addEventListener('input', function(e){

let v = e.target.value.replace(/\D/g,'');

if(v.length > 11){
    v = v.slice(0,11);
}

v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");

e.target.value = v;

});

document.getElementById('cep')
.addEventListener('input', function(e){

let v = e.target.value.replace(/\D/g,'');

if(v.length > 8){
    v = v.slice(0,8);
}

v = v.replace(/(\d{5})(\d)/,'$1-$2');

e.target.value = v;

});

const cidade = document.querySelector('input[name="cidade"]');
const estado = document.getElementById('estado');
const regiao = document.getElementById('regiao');
const cepInput = document.getElementById('cep');

/* =========================
   BUSCAR CEP
========================= */

async function buscarCEP(){

    let cep = cepInput.value.replace(/\D/g,'');

    if(cep.length != 8){
        return;
    }

    try{

        const resposta =
        await fetch(`https://viacep.com.br/ws/${cep}/json/`);

        const dados = await resposta.json();

        if(dados.erro){
            alert("CEP não encontrado.");
            return;
        }

        document.querySelector('input[name="endereco"]').value =
        dados.logradouro || '';

        document.querySelector('input[name="bairro"]').value =
        dados.bairro || '';

        cidade.value = dados.localidade || '';

        estado.value = dados.uf || '';

        verificarEntrega();

    }
    catch(error){

        console.log(error);

    }

}

/* QUANDO SAI DO INPUT */
cepInput.addEventListener('blur', buscarCEP);

/* QUANDO APERTA ENTER */
cepInput.addEventListener('keydown', async function(e){

    if(e.key === 'Enter'){

        e.preventDefault();

        await buscarCEP();

        document.querySelector('input[name="numero"]').focus();
    }
});

function verificarEntrega(){

let cidadeValor =
cidade.value.toLowerCase().trim();

let estadoValor =
estado.value.toUpperCase().trim();

if(
cidadeValor === 'rio de janeiro'
&&
estadoValor === 'RJ'
){

regiao.disabled = false;

if(regiao.value === 'Entrega Externa'){
    regiao.value = '';
}

}
else{

regiao.value = 'Entrega Externa';
regiao.disabled = true;

}

}

cidade.addEventListener('input', verificarEntrega);

estado.addEventListener('change', verificarEntrega);

window.addEventListener('load', verificarEntrega);

</script>

</body>
</html>
