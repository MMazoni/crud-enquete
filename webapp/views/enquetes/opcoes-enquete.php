<?php include __DIR__ . '/../inicio.php'; ?>

<div class="container">
    <div class="flex space-between">
        <h1>
            Enquete <?= $enquete['id_enquete'] ?>
        </h1>
        <h3>
            Data de inicio <?= date('d/m/Y H:i', strtotime($DATA_INICIO)) ?> -
            Data de termino <?= date('d/m/Y H:i', strtotime($DATA_TERMINO)) ?>
        </h3>
    </div>
    <section>
        <h2>
            <?= $enquete['titulo'] ?>
        </h2>
        <?php foreach ($opcoes as $key => $opcao) : ?>
            <div class="container-question">
                <div class="flex space-between">
                    <button type="button" onclick="setResponse(<?=$opcao['id_opcao']?>)" class="response-<?=$opcao['id_opcao']?>">
                        <span><?= $alternativas[$i] ?></span>
                        <?= $opcao['nome'] ?>
                    </button>
                    <p id="qnt-votos-<?=$opcao['id_opcao']?>" class="<?= $DATA_TERMINO >= date("Y-m-d H:i:s") ? 'hide': ''?>"><?= $opcao['qnt_votos'] ?> votos</p>
                </div>
                <div class="flex space-between <?= $DATA_TERMINO >= date("Y-m-d H:i:s") ? 'hide': ''?>">
                    <div class="flex container-question-percent">
                        <div id="barra-porc-<?=$opcao['id_opcao']?>"></div>
                        <div id="barra-falt-<?=$opcao['id_opcao']?>"></div>
                    </div>
                    <p id="porc-votos-<?=$opcao['id_opcao']?>"><?= $this->porcentagemVotos($opcao['qnt_votos']) ?></p>
                </div>
            </div>
        <?php
        $i++; 
        endforeach; 
        ?>
    </section>
    <div class="flex space-end">
        <button type="button" class="btn-voltar" onclick="location.href = '/'">Retornar início</button>
        <button type="button" id="btn-vote" <?= $DATA_TERMINO < date("Y-m-d H:i:s") || $DATA_INICIO > date("Y-m-d H:i:s") ? 'disabled': ''?> onclick="onSubmit(<?= $enquete['id_enquete'] ?>)" class="btn-success">Votar</button>
        <button type="button" id="btn-return" class="btn-success hide" onclick="location.reload();">Votar novamente</button>
    </div>
</div>
<?php include __DIR__ . '/../fim.php'; ?>