<?php
require './config/autoload.php';

use SIGNOWEB\TestePratico\Controller\ListaEnquete;


$controlador = new ListaEnquete();
$controlador->processa_requisicao();
