<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="public/css/estilo.css">
</head>
<body>

<div class="ConteudoPrincipal tela-auth">
    <div class="CardPerfil">

        <h2>Login</h2>

        <form method="POST" action="?url=autenticar">

            <input
                type="email"
                name="email"
                placeholder="Email"
                required>

            <input
                type="password"
                name="senha"
                placeholder="Senha"
                required>

            <button class="Postar">
                Entrar
            </button>

        </form>

        <p>
            Não possui conta?
            <a href="?url=cadastro">
                Cadastre-se
            </a>
        </p>

    </div>
</div>

</body>
</html>