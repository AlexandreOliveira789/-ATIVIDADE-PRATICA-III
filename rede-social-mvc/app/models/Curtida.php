<?php

require_once __DIR__ . '/../../config/database.php';

class Curtida
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function usuarioCurtiu($usuarioId, $postId)
    {
        $sql = "
        SELECT id
        FROM curtidas
        WHERE usuario_id = ?
        AND post_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuarioId,
            $postId
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->num_rows > 0;
    }

    public function curtir(
        $usuarioId,
        $postId
    )
    {
        $sql = "
        INSERT INTO curtidas
        (usuario_id, post_id)
        VALUES (?, ?)
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuarioId,
            $postId
        );

        return $stmt->execute();
    }

    public function descurtir(
        $usuarioId,
        $postId
    )
    {
        $sql = "
        DELETE FROM curtidas
        WHERE usuario_id = ?
        AND post_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuarioId,
            $postId
        );

        return $stmt->execute();
    }

    public function totalCurtidas(
        $postId
    )
    {
        $sql = "
        SELECT COUNT(*) as total
        FROM curtidas
        WHERE post_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "i",
            $postId
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc()['total'];
    }
}