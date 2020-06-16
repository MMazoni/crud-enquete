<?php 

namespace SIGNOWEB\TestePratico;

use SIGNOWEB\TestePratico\Conexao;


class Status
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = Conexao::conectar_banco();
    }

    public function listar_todos(): array
    {
        $resultado = $this->mysql->query('SELECT * FROM Estados');
        $status = $resultado->fetch_all(MYSQLI_ASSOC);
        return $status;
    }

    public function descricaoPorId(string $id): string
    {
        $selecionaStatus = $this->mysql->prepare('SELECT descricao FROM Estados WHERE id_status = ?');
        $selecionaStatus->bind_param('s', $id);
        $selecionaStatus->execute();
        $status = $selecionaStatus->get_result()->fetch_row();
        return $status[0];
    } 
    
    public function corStatus($id_status): string
    {
        switch ($id_status) {
            case 1:
                return 'todo';
            case 2:
                return 'progress';
            case 3:
                return 'done';

            default:
                echo 'Erro: Id do status inexistente.';
                break;
        }
    }

}