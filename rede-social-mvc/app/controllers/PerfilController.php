<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Seguidor.php';
require_once __DIR__ . '/../models/Post.php';

class PerfilController
{
    public function usuarios()
    {
        session_start();

        $usuario = new Usuario();

        $usuarios = $usuario->listarTodos();

        require_once __DIR__ . '/../views/feed/usuarios.php';
    }

    public function seguir()
    {
        session_start();

        $seguidorId = $_SESSION['usuario']['id'];
        $seguindoId = $_GET['id'];

        $seguidor = new Seguidor();

        if (!$seguidor->segue($seguidorId, $seguindoId)) {
            $seguidor->seguir($seguidorId, $seguindoId);
        }

        header("Location: ?url=usuarios");
        exit;
    }

    public function deixarDeSeguir()
    {
        session_start();

        $seguidorId = $_SESSION['usuario']['id'];
        $seguindoId = $_GET['id'];

        $seguidor = new Seguidor();

        $seguidor->deixarDeSeguir(
            $seguidorId,
            $seguindoId
        );

        header("Location: ?url=usuarios");
        exit;
    }

    public function meuPerfil()
    {
        session_start();

        $usuarioId = $_SESSION['usuario']['id'];

        $seguidor = new Seguidor();
        $post = new Post();

        $totalSeguidores =
            $seguidor->totalSeguidores(
                $usuarioId
            );

        $totalSeguindo =
            $seguidor->totalSeguindo(
                $usuarioId
            );

        $totalPosts =
            $post->contarPostsUsuario(
                $usuarioId
            );

        require_once
        __DIR__ .
        '/../views/feed/perfil.php';
    }

    public function perfilUsuario()
    {
        session_start();

        $usuarioId = $_GET['id'];

        $usuarioModel = new Usuario();
        $seguidor = new Seguidor();
        $post = new Post();

        $usuario =
            $usuarioModel->buscarPorId(
                $usuarioId
            );

        if (!$usuario) {
            die("Usuário não encontrado.");
        }

        $totalSeguidores =
            $seguidor->totalSeguidores(
                $usuarioId
            );

        $totalSeguindo =
            $seguidor->totalSeguindo(
                $usuarioId
            );

        $totalPosts =
            $post->contarPostsUsuario(
                $usuarioId
            );

        $posts =
            $post->listarPorUsuario(
                $usuarioId
            );

        require_once
        __DIR__ .
        '/../views/feed/perfil-usuario.php';
    }

    public function busca()
    {
        session_start();

        $usuarios = [];

        if (isset($_GET['q'])) {

            $usuario = new Usuario();

            $usuarios =
                $usuario->buscar(
                    $_GET['q']
                );
        }

        require_once
        __DIR__ .
        '/../views/feed/busca.php';
    }

    public function editarPerfil()
    {
        session_start();

        $nome =
            trim($_POST['nome']);

        $username =
            trim($_POST['username']);

        $email =
            trim($_POST['email']);

        if (
            empty($nome) ||
            empty($username) ||
            empty($email)
        ) {
            die(
                "Todos os campos são obrigatórios."
            );
        }

        $usuario = new Usuario();

        $usuario->atualizarPerfil(
            $_SESSION['usuario']['id'],
            $nome,
            $username,
            $email
        );

        $_SESSION['usuario']['nome'] =
            $nome;

        $_SESSION['usuario']['username'] =
            $username;

        $_SESSION['usuario']['email'] =
            $email;

        header("Location: ?url=perfil");
        exit;
    }

    public function alterarSenha()
    {
        session_start();

        $senha =
            trim(
                $_POST['senha']
            );

        $confirmar =
            trim(
                $_POST['confirmar']
            );

        if (
            empty($senha)
        ) {
            die(
                "Digite uma senha."
            );
        }

        if (
            $senha !=
            $confirmar
        ) {
            die(
                "As senhas não coincidem."
            );
        }

        $hash =
            password_hash(
                $senha,
                PASSWORD_DEFAULT
            );

        $usuario =
            new Usuario();

        $usuario->alterarSenha(
            $_SESSION['usuario']['id'],
            $hash
        );

        header(
            "Location: ?url=perfil"
        );
        exit;
    }

    public function alterarFoto()
    {
        session_start();

        if (!isset($_FILES['foto'])) {
            die("Nenhuma foto enviada.");
        }

        $arquivo = $_FILES['foto'];

        $extensao = strtolower(
            pathinfo(
                $arquivo['name'],
                PATHINFO_EXTENSION
            )
        );

        $permitidas = [
            'jpg',
            'jpeg',
            'png'
        ];

        if (!in_array($extensao, $permitidas)) {
            die("Formato inválido.");
        }

        $nomeArquivo =
            time() .
            "_" .
            basename(
                $arquivo['name']
            );

        move_uploaded_file(
            $arquivo['tmp_name'],
            __DIR__ .
            '/../../public/uploads/' .
            $nomeArquivo
        );

        $usuario = new Usuario();

        $usuario->atualizarFoto(
            $_SESSION['usuario']['id'],
            $nomeArquivo
        );

        $_SESSION['usuario']['foto'] =
            $nomeArquivo;

        header("Location: ?url=perfil");
        exit;
    }
}