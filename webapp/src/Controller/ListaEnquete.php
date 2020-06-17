<?php

namespace SIGNOWEB\TestePratico\Controller;

use SIGNOWEB\TestePratico\Model\Enquete;
use SIGNOWEB\TestePratico\Model\Status;


class ListaEnquete implements InterfaceControladorRequisicao
{
    private $obj_enquete;

    public function __construct()
    {
        $this->obj_enquete = new Enquete();
    }

    public function processa_requisicao(): void
    {
        $enquetes = $this->obj_enquete->listar_todos();
        $obj_status = new Status();
        require __DIR__ . '/../../views/enquetes/lista-enquetes.php';
    }
}