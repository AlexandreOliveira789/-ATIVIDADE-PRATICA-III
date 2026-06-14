<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="public/css/estilo.css">
</head>
<body>

<div class="ConteudoPrincipal tela-auth">
    <div class="CardPerfil">

        <h2>Criar Conta</h2>
        <?php if(isset($_SESSION['erro'])): ?>

        <div class="alert-erro">
            <?= $_SESSION['erro']; ?>
        </div>

        <?php unset($_SESSION['erro']); ?>

        <?php endif; ?>

        <form method="POST" action="?url=salvar-cadastro">

            <input type="text" name="nome" placeholder="Nome completo" required>

            <input type="text" name="username" placeholder="Username" required>

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="senha" placeholder="Senha" required>

            <input type="password" name="confirmar" placeholder="Confirmar senha" required>

            <input type="date" name="data" required>

            <select name="genero">

                <option value="Feminino">
                    Feminino
                </option>

                <option value="Masculino">
                    Masculino
                </option>

                <option value="Outro">
                    Outro
                </option>

            </select>

            <button class="Postar">
                Cadastrar
            </button>

        </form>

    </div>
</div>

</body>
</html>