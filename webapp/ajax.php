<?php
require './config/autoload.php';

use SIGNOWEB\TestePratico\Controller\Votacao;


$controlador = new Votacao();
$controlador->processa_requisicao();