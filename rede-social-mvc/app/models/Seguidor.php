<?php

require_once __DIR__ . '/../../config/database.php';

class Seguidor
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function segue(
        $seguidor,
        $seguindo
    )
    {
        $sql = "
        SELECT id
        FROM seguidores
        WHERE seguidor_id = ?
        AND seguindo_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $seguidor,
            $seguindo
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->num_rows > 0;
    }

    public function seguir(
        $seguidor,
        $seguindo
    )
    {
        $sql = "
        INSERT INTO seguidores
        (
            seguidor_id,
            seguindo_id
        )
        VALUES (?, ?)
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $seguidor,
            $seguindo
        );

        return $stmt->execute();
    }

    public function deixarDeSeguir(
        $seguidor,
        $seguindo
    )
    {
        $sql = "
        DELETE FROM seguidores
        WHERE seguidor_id = ?
        AND seguindo_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $seguidor,
            $seguindo
        );

        return $stmt->execute();
    }

    public function totalSeguidores(
        $usuarioId
    )
    {
        $sql = "
        SELECT COUNT(*) as total
        FROM seguidores
        WHERE seguindo_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "i",
            $usuarioId
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc()['total'];
    }

    public function totalSeguindo(
        $usuarioId
    )
    {
        $sql = "
        SELECT COUNT(*) as total
        FROM seguidores
        WHERE seguidor_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "i",
            $usuarioId
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc()['total'];
    }

    
}