<?php
session_start();
include 'includes/conexao.php';


if(!isset($_SESSION['usuario'])){
    header("Location: contas.php");
    exit;
}


if(empty($_SESSION['carrinho'])){
    header("Location: carrinho.php");
    exit;
}


$idUsuario = $_SESSION['id'];


/* =========================
   CLIENTE
========================= */
$sql = $pdo->prepare("
SELECT *
FROM clientes
WHERE usuario_id = ?
");


$sql->execute([$idUsuario]);


$cliente = $sql->fetch(PDO::FETCH_ASSOC);


/* =========================
   TOTAL CARRINHO
========================= */
$total = 0;


foreach($_SESSION['carrinho'] as $produto){


    $qtd = $produto['quantidade'];


    $total += $produto['preco'] * $qtd;
}


$frete = null;
$totalFinal = null;
$prazo = '';


/* =========================
   CALCULAR FRETE
========================= */
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $cep = trim(preg_replace('/\D/', '', $_POST['cep']));
    $endereco = trim($_POST['endereco']);
    $numero = trim($_POST['numero']);
    $bairro = trim($_POST['bairro']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);
    $regiao = trim($_POST['regiao']);


    /* =========================
       VALIDAÇÕES
    ========================= */


    if(empty($cep)){
        header("Location: frete.php?erro=cep_vazio");
        exit;
    }


    if(strlen($cep) != 8){
        header("Location: frete.php?erro=cep_invalido");
        exit;
    }


    if(empty($regiao)){
        header("Location: frete.php?erro=regiao_vazia");
        exit;
    }


    /* =========================
       FRETE GRÁTIS
    ========================= */


    $cidadeNormalizada = mb_strtolower(trim($cidade));

if(
    $cidadeNormalizada != 'rio de janeiro' ||
    strtoupper($estado) != 'RJ'
){

    $frete = 50;
    $prazo = "5 a 7 dias úteis";

    $msgFrete = "Entrega externa aplicada.";

    $regiao = 'Entrega Externa';

} else {

    if($total >= 1000){

        $frete = 0;
        $prazo = "1 a 3 dias úteis";

        $msgFrete = "Frete grátis aplicado!";

    } else {

        switch($regiao){

            case 'Centro':
                $frete = 15;
                $prazo = "1 dia útil";
            break;


            case 'Zona Sul':
                $frete = 20;
                $prazo = "2 dias úteis";
            break;


            case 'Zona Norte':
                $frete = 25;
                $prazo = "2 a 3 dias úteis";
            break;


            case 'Zona Oeste':
                $frete = 30;
                $prazo = "3 dias úteis";
            break;


            case 'Zona Sudoeste':
                $frete = 35;
                $prazo = "3 a 4 dias úteis";
            break;


            case 'Retirada na Loja':
                $frete = 0;
                $prazo = "Retirada imediata";
            break;


            default:
                $frete = 40;
                $prazo = "4 a 6 dias úteis";
        }


        $msgFrete = "Frete calculado com sucesso!";
    }
}

    $totalFinal = $total + $frete;


    $_SESSION['entrega'] = [


        'frete' => $frete,
        'prazo' => $prazo,


        'endereco' => [
            'cep' => $cep,
            'endereco' => $endereco,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado,
            'regiao' => $regiao
        ]
    ];


    /* =========================
       ATUALIZA CLIENTE
    ========================= */


    $update = $pdo->prepare("
    UPDATE clientes
    SET
    cep = ?,
    endereco = ?,
    numero = ?,
    bairro = ?,
    cidade = ?,
    estado = ?,
    regiao = ?
    WHERE usuario_id = ?
    ");


    $update->execute([
        $cep,
        $endereco,
        $numero,
        $bairro,
        $cidade,
        $estado,
        $regiao,
        $idUsuario
    ]);


    $sucessoFrete = true;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Entrega</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


:root{
    --roxo:#7c3aed;
    --roxo2:#6d28d9;
    --roxo3:#2e1065;
    --branco:#fff;
    --preto:#1e1e1e;
    --verde:#00b312;
    --vermelho:#e53935;
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Poppins;
}


body{
    background:var(--roxo3);
    padding:30px 15px;
    color:white;
}


.container{
    max-width:1200px;
    margin:auto;
    background:#ffffff10;
    backdrop-filter: blur(12px);
    padding:35px;
    border-radius:20px;
    border:1px solid rgba(255,255,255,0.1);
}


h1{
    text-align:center;
    margin-bottom:25px;
    font-size:32px;
}


.info{
    background:#ffffff15;
    padding:18px;
    border-radius:12px;
    margin-bottom:25px;
    line-height:1.8;
}


.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:20px;
}


.input-group{
    display:flex;
    flex-direction:column;
    gap:8px;
}


.input-group.full{
    grid-column:1 / -1;
}


label{
    font-weight:600;
}


input,
select{
    padding:15px;
    border:none;
    border-radius:12px;
    font-size:15px;
    outline:none;
}


input:focus,
select:focus{
    box-shadow:0 0 0 3px rgba(124,58,237,0.4);
}


small{
    font-size:13px;
    opacity:0.8;
}


.btn{
    width:100%;
    margin-top:25px;
    border:none;
    background:var(--roxo);
    color:white;
    padding:16px;
    border-radius:14px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
}


.btn:hover{
    background:var(--roxo2);
    transform:scale(1.01);
}


.resumo{
    margin-top:30px;
    background:#ffffff10;
    border-radius:18px;
    padding:25px;
}


.resumo h2{
    margin-bottom:20px;
}


.resumo-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}


.total{
    border-top:1px solid rgba(255,255,255,0.2);
    padding-top:15px;
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
}


.finalizar{
    margin-top:20px;
}


.finalizar a{
    text-decoration:none;
}


.finalizar button{
    width:100%;
    border:none;
    background:var(--verde);
    color:white;
    padding:15px;
    border-radius:14px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
}


.alerta,
.alerta-sucesso{
    position:fixed;
    top:20px;
    right:20px;
    padding:18px 24px;
    border-radius:12px;
    color:white;
    z-index:9999;
    display:flex;
    align-items:center;
    gap:12px;
}


.alerta{
    background:var(--vermelho);
}


.alerta-sucesso{
    background:var(--verde);
}


.fechar{
    cursor:pointer;
    font-weight:bold;
}


@media(max-width:768px){


    .container{
        padding:20px;
    }


    .form-grid{
        grid-template-columns:1fr;
    }


    h1{
        font-size:26px;
    }
}


</style>
</head>


<body>


<div class="container">


<h1>Entrega dos Produtos</h1>


<div class="info">


<strong>Informações importantes:</strong><br><br>


• Frete grátis para compras acima de R$1000.<br>


• Retirada na loja disponível gratuitamente.<br>


• O prazo varia conforme sua região.<br>


• Produtos enviados com segurança e rastreamento.


</div>


<form method="POST">


<div class="form-grid">


<div class="input-group">
<label>CEP</label>


<input
type="text"
id="cep"
name="cep"
maxlength="9"
placeholder="00000-000"
value="<?= $cliente['cep'] ?? '' ?>"
required>


</div>


<div class="input-group">
<label>Número</label>


<input
type="text"
name="numero"
placeholder="Número"
value="<?= $cliente['numero'] ?? '' ?>"
required>


</div>


<div class="input-group full">
<label>Endereço</label>


<input
type="text"
name="endereco"
placeholder="Rua / Avenida"
value="<?= $cliente['endereco'] ?? '' ?>"
required>


</div>


<div class="input-group">
<label>Bairro</label>


<input
type="text"
name="bairro"
placeholder="Bairro"
value="<?= $cliente['bairro'] ?? '' ?>"
required>


</div>

<div class="input-group">
<label>Cidade</label>

<input
type="text"
name="cidade"
id="cidade"
placeholder="Cidade"
value="<?= $cliente['cidade'] ?? '' ?>"
required>

</div>


<div class="input-group">
<label>Estado</label>

<select name="estado" id="estado" required>

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

    $selected = ($cliente['estado'] ?? '') == $sigla
    ? 'selected'
    : '';

    echo "<option value='$sigla' $selected>
    $nome ($sigla)
    </option>";
}

?>

</select>
</div>

<div class="input-group">

<label>Entrega</label>

<select name="regiao" id="regiao" required>

<option value="">Selecione</option>
<option value="Centro">Centro</option>
<option value="Zona Sul">Zona Sul</option>
<option value="Zona Norte">Zona Norte</option>
<option value="Zona Oeste">Zona Oeste</option>
<option value="Zona Sudoeste">Zona Sudoeste</option>
<option value="Entrega Externa">Entrega Externa</option>

<option value="Retirada na Loja">
Retirada na Loja
</option>

</select>

</div>

</div>

<button type="submit" class="btn">

<i class="fa-solid fa-truck"></i>
Calcular Entrega

</button>

</form>

<?php if($frete !== null): ?>

<div class="resumo">

<h2>Resumo da Entrega</h2>

<div class="resumo-item">
<span>Subtotal</span>
<span>R$ <?= number_format($total,2,',','.') ?></span>
</div>

<div class="resumo-item">
<span>Frete</span>
<span>R$ <?= number_format($frete,2,',','.') ?></span>
</div>

<div class="resumo-item">
<span>Prazo</span>
<span><?= $prazo ?></span>
</div>

<div class="resumo-item total">
<span>Total Final</span>
<span>R$ <?= number_format($totalFinal,2,',','.') ?></span>
</div>

<div class="finalizar">

<a href="checkout.php">

<button>

<i class="fa-solid fa-credit-card"></i>
Ir para Checkout

</button>

</a>

</div>

</div>

<?php endif; ?>

</div>

<script>

document.getElementById('cep').addEventListener('input', function(e){

    let v = e.target.value.replace(/\D/g,'');

    if(v.length > 8){
        v = v.slice(0,8);
    }

    v = v.replace(/(\d{5})(\d)/,'$1-$2');

    e.target.value = v;
});

const cidade = document.getElementById('cidade');
const estado = document.getElementById('estado');
const regiao = document.getElementById('regiao');
window.addEventListener('load', verificarEntrega);


function verificarEntrega(){

    let cidadeValor = cidade.value.toLowerCase().trim();
    let estadoValor = estado.value.toUpperCase().trim();

    if(
        cidadeValor === 'rio de janeiro' &&
        estadoValor === 'RJ'
    ){

        regiao.disabled = false;

        if(regiao.value === 'Entrega Externa'){
            regiao.value = '';
        }

    } else {
        regiao.value = 'Entrega Externa';
        regiao.disabled = true;
    }
}

cidade.addEventListener('input', verificarEntrega);
estado.addEventListener('change', verificarEntrega);

verificarEntrega();


</script>

<script>

const cepInput = document.getElementById('cep');

cepInput.addEventListener('blur', async function(){

    let cep = cepInput.value.replace(/\D/g,'');

    if(cep.length != 8){
        return;
    }

    try{

        const resposta = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const dados = await resposta.json();

        if(dados.erro){
            return;
        }

        document.querySelector('input[name="endereco"]').value = dados.logradouro || '';
        document.querySelector('input[name="bairro"]').value = dados.bairro || '';
        document.getElementById('cidade').value = dados.localidade || '';
        document.getElementById('estado').value = dados.uf || '';

    } catch(error){
        console.log(error);
    }

});

</script>

</body>
</html>
