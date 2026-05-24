<?php
session_start();
include '../includes/conexao.php';

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
    header("Location: ../contas.php");
    exit;
}

/* ALTERAR TIPO */
if(isset($_GET['alterar'])){

    $id = $_GET['alterar'];

    $sql = $pdo->prepare("
        SELECT tipo
        FROM usuarios
        WHERE id_usuario = ?
    ");

    $sql->execute([$id]);

    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if($usuario){

        $novoTipo = ($usuario['tipo'] == 'admin')
        ? 'cliente'
        : 'admin';

        $update = $pdo->prepare("
            UPDATE usuarios
            SET tipo = ?
            WHERE id_usuario = ?
        ");

        $update->execute([$novoTipo, $id]);
    }

    header("Location: usuarios.php");
    exit;
}

/* EXCLUIR */
if(isset($_GET['excluir'])){

    $id = $_GET['excluir'];

    $delete = $pdo->prepare("
        DELETE FROM usuarios
        WHERE id_usuario = ?
    ");

    $delete->execute([$id]);

    header("Location: usuarios.php");
    exit;
}

/* BUSCA */
$busca = "";


if(isset($_GET['busca'])){
    $busca = trim($_GET['busca']);
}


if($busca != ""){


    $sql = $pdo->prepare("
        SELECT
            u.*,
            COALESCE(c.nome, f.nome) AS nome


        FROM usuarios u


        LEFT JOIN clientes c
        ON c.usuario_id = u.id_usuario


        LEFT JOIN funcionarios f
        ON f.usuario_id = u.id_usuario


        WHERE
        COALESCE(c.nome, f.nome) LIKE ?
        OR u.email LIKE ?


        ORDER BY u.id_usuario DESC
    ");


    $sql->execute([
        "%$busca%",
        "%$busca%"
    ]);


}else{


    $sql = $pdo->query("
        SELECT
            u.*,
            COALESCE(c.nome, f.nome) AS nome


        FROM usuarios u


        LEFT JOIN clientes c
        ON c.usuario_id = u.id_usuario


        LEFT JOIN funcionarios f
        ON f.usuario_id = u.id_usuario


        ORDER BY u.id_usuario DESC
    ");
}


$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Usuários</title>

<link rel="stylesheet"
href="css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div class="main">

    <div class="top-page">

        <div>
            <h1>Usuários</h1>
            <p>
                Gerencie clientes e administradores da InfoGirls.
            </p>
        </div>

    </div>

    <div class="card-admin">

        <form method="GET" class="busca-form">

            <input
            type="text"
            name="busca"
            placeholder="Buscar por nome ou email..."
            value="<?= htmlspecialchars($busca) ?>">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </form>

    </div>

    <div class="card-admin">

        <table class="tabela">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>

            </thead>

            <tbody>

            <?php if(count($usuarios) > 0): ?>

                <?php foreach($usuarios as $usuario): ?>

                <tr>

                    <td>
                        #<?= $usuario['id_usuario']; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($usuario['nome']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($usuario['email']); ?>
                    </td>

                    <td>

                        <?php if($usuario['tipo'] == 'admin'): ?>

                            <span class="status entregue">
                                Admin
                            </span>

                        <?php else: ?>

                            <span class="status pendente">
                                Cliente
                            </span>

                        <?php endif; ?>

                    </td>

                    <td class="acoes">

                        <a
                        href="usuarios.php?alterar=<?= $usuario['id_usuario']; ?>"
                        class="btn-acao editar">

                            <i class="fa-solid fa-user-gear"></i>

                        </a>

                        <a
                        href="usuarios.php?excluir=<?= $usuario['id_usuario']; ?>"
                        class="btn-acao excluir"
                        onclick="return confirm('Deseja excluir este usuário?')">

                            <i class="fa-solid fa-trash"></i>

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5">

                        Nenhum usuário encontrado.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
