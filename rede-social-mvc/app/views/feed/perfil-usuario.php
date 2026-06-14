<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Perfil</title>

<link rel="stylesheet" href="/rede-social-mvc/public/css/estilo.css">

</head>

<body>

<div class="container">

    <div class="feed">

        <div class="CardPerfil">

            <h2>
                <?= htmlspecialchars($usuario['nome']); ?>
            </h2>

            <p>
                @<?= htmlspecialchars($usuario['username']); ?>
            </p>

            <p>
                <?= htmlspecialchars($usuario['email']); ?>
            </p>

        </div>

        <div class="estatisticas">

            <p>
                <strong><?= $totalPosts; ?></strong>
                Posts
            </p>

            <p>
                <strong><?= $totalSeguidores; ?></strong>
                Seguidores
            </p>

            <p>
                <strong><?= $totalSeguindo; ?></strong>
                Seguindo
            </p>

        </div>

        <h3>Posts</h3>

        <?php if(empty($posts)): ?>

            <div class="Post">
                <p>Nenhum post encontrado.</p>
            </div>

        <?php endif; ?>

        <?php foreach($posts as $post): ?>

            <div class="Post">

                <p>
                    <?= htmlspecialchars($post['conteudo']); ?>
                </p>

                <small>
                    ❤️ <?= $post['total_curtidas']; ?> curtidas
                </small>

            </div>

        <?php endforeach; ?>

        <br>

        <a href="?url=usuarios">
            ← Voltar
        </a>

    </div>

</div>

</body>
</html>