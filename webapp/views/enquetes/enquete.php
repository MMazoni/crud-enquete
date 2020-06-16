<?php
require 'autoload.php';

use SIGNOWEB\TestePratico\Enquete;

$obj_enquete = new Enquete();
$enqueteAtual = $obj_enquete->encontrarPorId($_GET['id']);