<?php include __DIR__ . '/../inicio.php';?>

<div class="container">
    <h1>
        SISTEMA DE VOTAÇÃO
    </h1>
    <div class="tabela-reponsiva">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Data inicio</th>
                    <th scope="col">Data Fim</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquetes as $enquete) : ?>
                    <tr onclick="location.href = '/enquete.php?id=<?= $enquete['id_enquete'] ?>'">
                        <td><?= $enquete['id_enquete'] ?></td>
                        <td><?= $enquete['titulo'] ?></td>
                        <td>
                            <?= date('d/m/Y H:i', strtotime($enquete['dt_inicio'])) ?>
                        </td>
                        <td>
                            <?= date('d/m/Y H:i', strtotime($enquete['dt_termino'])) ?>
                        </td>
                        <td><span class="<?= $obj_status->corStatus($enquete['id_status']) ?>">
                                <?= $obj_status->descricaoPorId($enquete['id_status']) ?>
                            </span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../fim.php';?>