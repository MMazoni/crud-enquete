<?php 

namespace SIGNOWEB\TestePratico\Model;

use SIGNOWEB\TestePratico\Conexao;


class Opcao
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = Conexao::conectar_banco();
    }

    public function listar_todos(): array
    {
        $resultado = $this->mysql->query('SELECT * FROM Opcoes');
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function encontrarPorIdEnquete(int $id) 
    {
        $selecionaOpcao = $this->mysql->prepare('SELECT id_opcao, id_enquete, nome, qnt_votos FROM Opcoes WHERE id_enquete = ?');
        $selecionaOpcao->bind_param('i', $id);
        $selecionaOpcao->execute();
        return  $selecionaOpcao->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function adicionar(int $id_enquete, string $nome): void
    {
        $insereOpcao = $this->mysql->prepare('INSERT INTO Opcoes(id_enquete, nome) VALUES(?, ?)');
        $insereOpcao->bind_param('is', $id_enquete, $nome);
        $insereOpcao->execute();
    }

    public function deletar(string $id): void
    {
        $deletarOpcao = $this->mysql->prepare('DELETE FROM Opcoes WHERE id_opcao = ?');
        $deletarOpcao->bind_param('s', $id);
        $deletarOpcao->execute();
    }

    public function editar(string $id, int $id_enquete, string $nome): void
    {
        $editaOpcao = $this->mysql->prepare('UPDATE Opcoes SET id_enquete = ?,
            nome = ? WHERE id_opcao = ?');
        $editaOpcao->bind_param('iss', $id_enquete, $nome, $id);
        $editaOpcao->execute();
    }

    public function votar(int $id_opcao, int $id_enquete): array
    {
        $resultado = $this->mysql->prepare('SELECT qnt_votos FROM Opcoes WHERE id_opcao = ? AND id_enquete = ?');
        $resultado->bind_param('ii', $id_opcao, $id_enquete);
        $resultado->execute();
        $numeroVotos = $resultado->get_result()->fetch_row();
        $numeroVotos[0]++;

        $editaOpcao = $this->mysql->prepare('UPDATE Opcoes SET qnt_votos = ? WHERE id_opcao = ? AND id_enquete = ?');
        $editaOpcao->bind_param('iii', $numeroVotos[0], $id_opcao, $id_enquete);
        $editaOpcao->execute();

        
        return $this->encontrarPorIdEnquete($id_enquete);
    }

    public function porcentagemVotos()
    {
        
    }
    
}