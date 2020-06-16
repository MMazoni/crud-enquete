<?php 

namespace SIGNOWEB\TestePratico;

class Enquete
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = Conexao::conectar_banco();
    }

    public function listar_todos(): array
    {
        $resultado = $this->mysql->query('SELECT * FROM Enquetes');
        $enquetes = $resultado->fetch_all(MYSQLI_ASSOC);
        return $enquetes;
    }

    public function encontrarPorId(string $id) :array
    {
        $selecionaEnquete = $this->mysql->prepare('SELECT * FROM Enquetes WHERE id_enquete = ?');
        $selecionaEnquete->bind_param('s', $id);
        $selecionaEnquete->execute();
        $enquete = $selecionaEnquete->get_result()->fetch_assoc();
        return $enquete;
    } 
    
    public function adicionar(string $titulo, string $dt_inicio, 
        string $dt_termino, int $id_status): void
    {
        $insereEnquete = $this->mysql->prepare('INSERT INTO Enquetes(titulo, dt_inicio, dt_termino, id_status) VALUES(?, ?, ?, ?)');
        $insereEnquete->bind_param('sssi', $titulo, $dt_inicio, $dt_termino, $id_status);
        $insereEnquete->execute();
    }

    public function deletar(string $id): void
    {
        $deletarEnquete = $this->mysql->prepare('DELETE FROM Enquetes WHERE id_enquete = ?');
        $deletarEnquete->bind_param('s', $id);
        $deletarEnquete->execute();
    }

    public function editar(string $id, string $titulo, 
        string $dt_inicio, string $dt_termino, int $id_status): void
    {
        $editaEnquete = $this->mysql->prepare('UPDATE Enquetes SET titulo = ?,
            dt_inicio = ?, dt_termino = ?, id_status = ? WHERE id_enquete = ?');
        $editaEnquete->bind_param('sssis', $titulo, $dt_inicio, $dt_termino, $id_status, $id);
        $editaEnquete->execute();
    }

}