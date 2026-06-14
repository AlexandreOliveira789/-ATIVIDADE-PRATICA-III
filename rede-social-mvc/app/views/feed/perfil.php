<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

$foto =
$_SESSION['usuario']['foto']
?? 'padrao.png';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Meu Perfil</title>

<link rel="stylesheet" href="public/css/estilo.css">

</head>

<body>

<div class="CardPerfil">

    <img
    src="public/uploads/<?= $foto; ?>"
    width="150">

    <br><br>

    <form
    method="POST"
    action="?url=alterar-foto"
    enctype="multipart/form-data">

        <input
        type="file"
        name="foto"
        required>

        <button>
            Alterar Foto
        </button>

    </form>

    <hr>

    <h2>
        Editar Perfil
    </h2>

    <form
    method="POST"
    action="?url=editar-perfil">

        <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($_SESSION['usuario']['nome']); ?>"
        required>

        <br><br>

        <input
        type="text"
        name="username"
        value="<?= htmlspecialchars($_SESSION['usuario']['username']); ?>"
        required>

        <br><br>

        <input
        type="email"
        name="email"
        value="<?= htmlspecialchars($_SESSION['usuario']['email']); ?>"
        required>

        <br><br>

        <button>
            Salvar Alterações
        </button>

    </form>

    <hr>

    <h2>
        Alterar Senha
    </h2>

    <form
    method="POST"
    action="?url=alterar-senha">

        <input
        type="password"
        name="senha"
        placeholder="Nova senha"
        required>

        <br><br>

        <input
        type="password"
        name="confirmar"
        placeholder="Confirmar senha"
        required>

        <br><br>

        <button>
            Alterar Senha
        </button>

    </form>

    <hr>

    <h2>
        <?= htmlspecialchars($_SESSION['usuario']['nome']); ?>
    </h2>

    <p>
        @<?= htmlspecialchars($_SESSION['usuario']['username']); ?>
    </p>

    <p>
        <?= htmlspecialchars($_SESSION['usuario']['email']); ?>
    </p>

    <hr>

    <p>
        Posts:
        <?= $totalPosts; ?>
    </p>

    <p>
        Seguidores:
        <?= $totalSeguidores; ?>
    </p>

    <p>
        Seguindo:
        <?= $totalSeguindo; ?>
    </p>

    <hr>

    <a href="?url=feed">
        Voltar ao Feed
    </a>

</div>

</body>
</html>
