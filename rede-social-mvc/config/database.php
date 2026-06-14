<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "rede_social";

    public function conectar()
    {
        $conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        return $conn;
    }
}