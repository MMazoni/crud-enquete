<?php
require './config/autoload.php';

use SIGNOWEB\TestePratico\Controller\EnqueteParaVotacao;


$controlador = new EnqueteParaVotacao();
$controlador->processa_requisicao();