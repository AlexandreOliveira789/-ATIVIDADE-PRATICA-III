<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/PerfilController.php';

$rota = $_GET['url'] ?? '';

$auth = new AuthController();
$post = new PostController();
$perfil = new PerfilController();

switch($rota)
{
    case '':
    case 'login':
        $auth->login();
        break;

        case 'usuarios':
    $perfil->usuarios();
    break;

        case 'seguir':
    $perfil->seguir();
    break;

    case 'perfil':
    $perfil->meuPerfil();
    break;

        case 'deixar-seguir':
    $perfil->deixarDeSeguir();
    break;

    case 'cadastro':
        $auth->cadastro();
        break;

    case 'salvar-cadastro':
        $auth->salvarCadastro();
        break;

        case 'busca':
        $perfil->busca();
        break;

        case 'perfil-usuario':
        $perfil->perfilUsuario();
        break;

    case 'autenticar':
        $auth->autenticar();
        break;

        case 'alterar-senha':
    $perfil->alterarSenha();
    break;

        case 'editar-perfil':
    $perfil->editarPerfil();
    break;

    case 'alterar-foto':
    $perfil->alterarFoto();
    break;

    case 'logout':
        $auth->logout();
        break;

    case 'feed':
        $post->feed();
        break;

    case 'criar-post':
        $post->criar();
        break;

        case 'curtir':
        $post->curtir();
        break;

    default:
        echo "Página não encontrada";
        break;
}