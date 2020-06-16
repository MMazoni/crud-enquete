<?php
require './config/autoload.php';

use SIGNOWEB\TestePratico\Enquete;
use SIGNOWEB\TestePratico\Status;

$obj_enquete = new Enquete();
$enquetes = $obj_enquete->listar_todos();
$obj_status = new Status();



?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Matheus Mazoni - Enquetes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/main.css">
    <script src="main.js"></script>
</head>
<body>
    <main>
        <div class="container">
            <h1>
                SISTEMA DE VOTAÇÃO 
            </h1>
            <div class="tabela-reponsiva">
                <table>
                    <!-- <caption> Frutinhas </caption> -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Data inicio</th>
                            <th>Data Fim</th>
                            <th>Status</th>
                        </tr>
                        </thead>		
                    <tbody>
                        <?php foreach($enquetes as $enquete): ?>
                        <tr>
                            <td><?=$enquete['id_enquete']?></td>
                            <td><?=$enquete['titulo']?></td>
                            <td>
                                <?=date('d/m/Y', strtotime($enquete['dt_inicio']))?>
                            </td>
                            <td>
                                <?=date('d/m/Y', strtotime($enquete['dt_termino']))?>
                            </td>
                            <td><span class="<?=$obj_status->corStatus($enquete['id_status'])?>">
                                <?=$obj_status->descricaoPorId($enquete['id_status'])?>
                            </span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>