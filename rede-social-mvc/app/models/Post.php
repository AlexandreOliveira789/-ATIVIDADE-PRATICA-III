<?php

require_once __DIR__ . '/../../config/database.php';

class Post
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function criar($usuarioId, $conteudo)
    {
        $sql = "INSERT INTO posts (usuario_id, conteudo)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "is",
            $usuarioId,
            $conteudo
        );

        return $stmt->execute();
    }

    public function listarTodos()
{
    $sql = "

    SELECT
        posts.*,
        usuarios.nome,
        usuarios.username,
        usuarios.foto,

        (
            SELECT COUNT(*)
            FROM curtidas
            WHERE curtidas.post_id = posts.id
        ) as total_curtidas

    FROM posts

    INNER JOIN usuarios
        ON usuarios.id =
        posts.usuario_id

    ORDER BY
        posts.created_at DESC
    ";

    $resultado =
        $this->conn->query($sql);

    return $resultado
        ->fetch_all(
            MYSQLI_ASSOC
        );
}

    public function contarPostsUsuario($usuarioId)
    {
        $sql = "
        SELECT COUNT(*) as total
        FROM posts
        WHERE usuario_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $usuarioId);

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc()['total'];
    }

    public function listarPorUsuario($usuarioId)
{
    $sql = "

    SELECT
        posts.*,

        (
            SELECT COUNT(*)
            FROM curtidas
            WHERE curtidas.post_id =
            posts.id
        ) as total_curtidas

    FROM posts

    WHERE usuario_id = ?

    ORDER BY created_at DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $usuarioId
    );

    $stmt->execute();

    return $stmt
        ->get_result()
        ->fetch_all(
            MYSQLI_ASSOC
        );
}
}