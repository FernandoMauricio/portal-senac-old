<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<div class="planilhadecurso-enviar-planejamento" style="text-align: center;">

    <?= Html::a('Programação Anual', ['enviar-programacao-anual'], ['class' => 'btn btn-info', 'style' => 'margin-right: 100px']) ?>

    <?= Html::a('Retificativo', ['enviar-programacao-retificativo'], ['class' => 'btn btn-danger']) ?>

</div>