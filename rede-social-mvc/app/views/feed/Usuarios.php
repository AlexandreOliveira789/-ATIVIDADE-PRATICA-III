<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/Seguidor.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">

<title>Usuários</title>

<link rel="stylesheet" href="public/css/estilo.css">

</head>

<body>

<div class="container">

    <div class="feed">

        <div class="novo-post">

            <h2>Usuários cadastrados</h2>

        </div>

        <?php foreach($usuarios as $u): ?>

            <?php

            if ($u['id'] == $_SESSION['usuario']['id']) {
                continue;
            }

            $seguidor = new Seguidor();

            $segue = $seguidor->segue(
                $_SESSION['usuario']['id'],
                $u['id']
            );

            $totalSeguidores =
            $seguidor->totalSeguidores(
            $u['id']
            );

            ?>

            <div class="usuario-card">

                <div class="usuario-info">

                    <h3>
                        <?= htmlspecialchars($u['nome']); ?>
                    </h3>

                    <p>
                        @<?= htmlspecialchars($u['username']); ?>
                    </p>

                    <?php
                    $totalSeguindo =
                    $seguidor->totalSeguindo(
                        $u['id']
                    );
                    ?>

                    <small>
                        👥 <?= $totalSeguidores; ?> seguidores
                        •
                        ➜ <?= $totalSeguindo; ?> seguindo
                    </small>

                </div>

                <div class="usuario-acoes">

                    <?php if($segue): ?>

                        <a href="?url=deixar-seguir&id=<?= $u['id']; ?>">
                            Deixar de seguir
                        </a>

                    <?php else: ?>

                        <a href="?url=seguir&id=<?= $u['id']; ?>">
                            Seguir
                        </a>

                    <?php endif; ?>

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