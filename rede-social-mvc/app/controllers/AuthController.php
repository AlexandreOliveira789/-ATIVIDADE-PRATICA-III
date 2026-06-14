<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function cadastro()
    {
        require_once __DIR__ . '/../views/auth/cadastro.php';
    }

    public function salvarCadastro()
    {
        $nome = trim($_POST['nome']);
        $username = trim($_POST['username']);
        $email = filter_var(
            $_POST['email'],
            FILTER_SANITIZE_EMAIL
        );

        $senha = $_POST['senha'];
        $confirmar = $_POST['confirmar'];

        if (
            empty($nome) ||
            empty($username) ||
            empty($email) ||
            empty($_POST['data']) ||
            empty($_POST['genero'])
        ) {
            die("Preencha todos os campos.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Email inválido.");
        }

        if (
            !preg_match(
                '/^(?=.*[A-Z])(?=.*\d).{6,}$/',
                $senha
            )
        ) {
            die("Senha deve ter 6 caracteres, 1 letra maiúscula e 1 número.");
        }

        if ($senha !== $confirmar) {
            die("As senhas não coincidem.");
        }

        $usuario = new Usuario();

        if ($usuario->buscarPorEmail($email)) {
            die("Este email já está cadastrado.");
        }

        if ($usuario->buscarPorUsername($username)) {
            die("Este username já está em uso.");
        }

        $usuario->cadastrar([
            'nome' => $nome,
            'username' => $username,
            'email' => $email,
            'senha' => password_hash(
                $senha,
                PASSWORD_DEFAULT
            ),
            'data_nascimento' => $_POST['data'],
            'genero' => $_POST['genero']
        ]);

        header("Location: ?");
        exit;
    }

    public function autenticar()
    {
        session_start();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuarioModel = new Usuario();

        $usuario =
            $usuarioModel->buscarPorEmail($email);

        if (
            !$usuario ||
            !password_verify(
                $senha,
                $usuario['senha']
            )
        ) {
            die("Email ou senha inválidos.");
        }

        $_SESSION['usuario'] = $usuario;

        header("Location: ?url=feed");
        exit;
    }

    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: ?");
        exit;
    }
}