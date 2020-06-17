<?php 

namespace SIGNOWEB\TestePratico\Model;

use SIGNOWEB\TestePratico\Conexao;

class Enquete
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = Conexao::conectar_banco();
    }

    public function validarData()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $id_status = 3;
        $editaEnquete = $this->mysql->prepare('UPDATE Enquetes SET  id_status = ? WHERE dt_termino < ?');
        $editaEnquete->bind_param('is', $id_status, date('Y-m-d H:i'));
        $editaEnquete->execute();

        $id_status = 1;
        $editaEnquete = $this->mysql->prepare('UPDATE Enquetes SET  id_status = ? WHERE dt_inicio > ?');
        $editaEnquete->bind_param('is', $id_status, date('Y-m-d H:i'));
        $editaEnquete->execute();

        $id_status = 2;
        $editaEnquete = $this->mysql->prepare('UPDATE Enquetes SET  id_status = ? WHERE ? BETWEEN dt_inicio AND dt_termino');
        $editaEnquete->bind_param('is', $id_status, date('Y-m-d H:i'));
        $editaEnquete->execute();
    }
    public function listar_todos(): array
    {
        $this->validarData();
        $resultado = $this->mysql->query("SELECT * from Enquetes as e WHERE 
        (SELECT count(*) FROM Opcoes WHERE id_enquete = e.id_enquete) > 2");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function encontrarPorId(int $id) :array
    {
        $selecionaEnquete = $this->mysql->prepare('SELECT * FROM Enquetes WHERE id_enquete = ?');
        $selecionaEnquete->bind_param('i', $id);
        $selecionaEnquete->execute();
        return $selecionaEnquete->get_result()->fetch_assoc();
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