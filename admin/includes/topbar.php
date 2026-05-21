<div class="topbar">

    <div class="topbar-esquerda">

        <h2>Painel Administrativo</h2>

    </div>

    <div class="topbar-direita">

        <div class="admin-user">

            <div class="avatar-admin">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="admin-info">

                <span class="nome-admin">
                    <?= $_SESSION['nome'] ?? 'Admin'; ?>
                </span>

                <small>
                    Administrador
                </small>

            </div>

        </div>

        <a href="../logout.php" class="btn-sair">

            <i class="fa-solid fa-right-from-bracket"></i>

            Sair

        </a>

    </div>

</div>
