<?php

    echo $this->render('_form', [
        'model' => $model,
        'cargos' => $cargos,
        'curriculosEndereco' => $curriculosEndereco,
        'curriculosFormacao' => $curriculosFormacao,
        'modelsComplemento' => (empty($modelsComplemento)) ? [new CurriculosComplemento] : $modelsComplemento,
        'modelsEmpregos' => (empty($modelsEmpregos)) ? [new CurriculosEmpregos] : $modelsEmpregos
    ])
?>

