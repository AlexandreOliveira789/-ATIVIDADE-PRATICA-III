<?php

require_once __DIR__ . '/../../config/database.php';

class Usuario
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarPorUsername($username)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $username);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarPorId($id)
    {
        $sql = "
        SELECT *
        FROM usuarios
        WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc();
    }

    public function listarTodos()
    {
        $sql = "
        SELECT *
        FROM usuarios
        ORDER BY nome
        ";

        $resultado = $this->conn->query($sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function buscar($termo)
    {
        $sql = "
        SELECT *
        FROM usuarios
        WHERE nome LIKE ?
        OR username LIKE ?
        ";

        $stmt = $this->conn->prepare($sql);

        $pesquisa = "%" . $termo . "%";

        $stmt->bind_param(
            "ss",
            $pesquisa,
            $pesquisa
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_all(MYSQLI_ASSOC);
    }

    public function cadastrar($dados)
    {
        $sql = "
        INSERT INTO usuarios
        (
            nome,
            username,
            email,
            senha,
            data_nascimento,
            genero
        )
        VALUES (?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssssss",
            $dados['nome'],
            $dados['username'],
            $dados['email'],
            $dados['senha'],
            $dados['data_nascimento'],
            $dados['genero']
        );

        return $stmt->execute();
    }

    public function atualizarFoto(
        $usuarioId,
        $foto
    )
    {
        $sql = "
        UPDATE usuarios
        SET foto = ?
        WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "si",
            $foto,
            $usuarioId
        );

        return $stmt->execute();
    }

    public function atualizarPerfil(
        $id,
        $nome,
        $username,
        $email
    )
    {
        $sql = "
        UPDATE usuarios
        SET
            nome = ?,
            username = ?,
            email = ?
        WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $nome,
            $username,
            $email,
            $id
        );

        return $stmt->execute();
    }

    public function alterarSenha(
    $id,
    $senha
)
{
    $sql = "
    UPDATE usuarios
    SET senha = ?
    WHERE id = ?
    ";

    $stmt =
    $this->conn->prepare($sql);

    $stmt->bind_param(
        "si",
        $senha,
        $id
    );

    return $stmt->execute();
}
}