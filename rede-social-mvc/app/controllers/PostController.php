<?php

require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Curtida.php';

class PostController
{
    public function curtir()
{
    session_start();

    $usuarioId =
        $_SESSION['usuario']['id'];

    $postId =
        $_POST['post_id'];

    $curtida =
        new Curtida();

    if (
        $curtida->usuarioCurtiu(
            $usuarioId,
            $postId
        )
    ) {

        $curtida->descurtir(
            $usuarioId,
            $postId
        );

    } else {

        $curtida->curtir(
            $usuarioId,
            $postId
        );
    }

    echo json_encode([
        'total' =>
        $curtida->totalCurtidas(
            $postId
        )
    ]);
}
        public function feed()
    {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: ?");
            exit;
        }

        $postModel = new Post();

        $posts = $postModel->listarTodos();

        require_once
        __DIR__ .
        '/../views/feed/feed.php';
    }

    public function criar()
    {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: ?");
            exit;
        }

        $conteudo = trim(
            $_POST['conteudo']
        );

        if (empty($conteudo)) {
            die("O post não pode estar vazio.");
        }

        $postModel = new Post();

        $postModel->criar(
            $_SESSION['usuario']['id'],
            $conteudo
        );

        header("Location: ?url=feed");
        exit;
    }
}