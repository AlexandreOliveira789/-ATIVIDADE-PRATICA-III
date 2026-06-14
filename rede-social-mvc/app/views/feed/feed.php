<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Feed</title>

<link rel="stylesheet" href="public/css/estilo.css">

</head>
<body>

<div class="container">

    <div class="sidebar">

        <img src="public/uploads/<?= !empty($_SESSION['usuario']['foto']) ? $_SESSION['usuario']['foto'] : 'padrao.png'; ?>"
alt="Foto">
        <h2>
            <?= htmlspecialchars($_SESSION['usuario']['nome']); ?>
        </h2>

        <p>
            @<?= htmlspecialchars($_SESSION['usuario']['username']); ?>
        </p>

        <a href="?url=perfil">
            Meu Perfil
        </a>

        <a href="?url=usuarios">
            Encontrar Usuários
        </a>

        <a href="?url=busca">
            Buscar Usuários
        </a>

        <a href="?url=logout">
            Sair
        </a>

    </div>

    <div class="feed">

        <div class="novo-post">

            <form
            method="POST"
            action="?url=criar-post">

                <input
                type="text"
                name="conteudo"
                placeholder="O que está acontecendo?"
                required>

                <button type="submit">
                    Publicar
                </button>

            </form>

        </div>

        <?php foreach(($posts ?? []) as $post): ?>

            <div class="post">

                <div class="post-topo">

                    <img
src="public/uploads/<?= !empty($post['foto']) ? $post['foto'] : 'padrao.png'; ?>"
alt="Foto">

                    <div>

                        <h3>
                            <?= htmlspecialchars($post['nome']); ?>
                        </h3>

                        <p class="username">
                            @<?= htmlspecialchars($post['username']); ?>
                        </p>

                    </div>

                </div>

                <div class="post-conteudo">

                    <?= nl2br(htmlspecialchars($post['conteudo'])); ?>

                </div>

                <div class="post-footer">

                    <button
                    class="btn-curtir"
                    onclick="curtirPost(<?= $post['id']; ?>, this)">

                        ❤️
                        <span>
                            <?= $post['total_curtidas']; ?>
                        </span>

                    </button>

                    <small>
                        <?= $post['created_at']; ?>
                    </small>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<script src="public/js/script.js"></script>

</body>
</html>