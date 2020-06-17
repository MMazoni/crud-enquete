<?php

namespace SIGNOWEB\TestePratico\Controller;

use SIGNOWEB\TestePratico\Model\Enquete;
use SIGNOWEB\TestePratico\Model\Opcao;

class EnqueteParaVotacao implements InterfaceControladorRequisicao
{
    private $obj_enquete;
    private $obj_opcao;
    private $votosTotal;

    public function __construct()
    {
        $this->obj_enquete = new Enquete();
        $this->obj_opcao = new Opcao();
        $this->votosTotal = 0;
    }

    public function processa_requisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (is_null($id) || $id === false) {
            header('Location: /');
            return ;
        }
        $i = 0;
        $enquete = $this->obj_enquete->encontrarPorId($id);
        $opcoes = $this->obj_opcao->encontrarPorIdEnquete($enquete['id_enquete']);
        $alternativas = $this->ordenarAlternativas(count($opcoes));

        foreach ($opcoes as $opcao) {
            $this->votosTotal = $this->votosTotal + $opcao['qnt_votos'];
        }
        $DATA_INICIO = $enquete['dt_inicio'];
        $DATA_TERMINO = $enquete['dt_termino'];
        
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        require __DIR__ . '/../../views/enquetes/opcoes-enquete.php';
    }
    
    public function ordenarAlternativas(int $quantidade): array
    {
        return range('a', chr(ord('a') + $quantidade)); 
    }

    public function porcentagemVotos($qnt_votos): string
    {
        return strval(($qnt_votos/$this->votosTotal) * 100) . '%';
    }

}