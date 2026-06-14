<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Buscar Usuários</title>

<link rel="stylesheet" href="/rede-social-mvc/public/css/estilo.css">

</head>
<body>

<div class="container">

    <div class="feed">

        <div class="novo-post">

            <h2>Buscar Usuários</h2>

            <br>

            <form method="GET">

                <input
                type="hidden"
                name="url"
                value="busca">

                <input
                type="text"
                name="q"
                placeholder="Nome ou username">

                <button type="submit">
                    Buscar
                </button>

            </form>

        </div>

        <?php foreach($usuarios as $u): ?>

            <div class="usuario-card">

                <div class="usuario-info">

                    <h3>
                        <?= htmlspecialchars($u['nome']); ?>
                    </h3>

                    <p>
                        @<?= htmlspecialchars($u['username']); ?>
                    </p>

                </div>

                <div class="usuario-acoes">

                    <a href="?url=perfil-usuario&id=<?= $u['id']; ?>">
                        Ver Perfil
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

        <br>

        <a href="?url=feed">
            ← Voltar ao Feed
        </a>

    </div>

</div>

</body>
</html>