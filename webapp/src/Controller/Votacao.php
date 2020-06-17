<?php

namespace SIGNOWEB\TestePratico\Controller;

use SIGNOWEB\TestePratico\Model\Opcao;

class Votacao implements InterfaceControladorRequisicao
{
    private $obj_opcao;

    public function __construct()
    {
        $this->obj_opcao = new Opcao();
    }

    public function processa_requisicao(): void
    {
        $json = $this->obj_opcao->votar($_POST['id_opcao'], $_POST['id_enquete']);

        header('Content-type: application/json');

        echo json_encode($json);

    }
}