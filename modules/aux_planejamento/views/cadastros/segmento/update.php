<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Segmento */

$this->title = 'Atualizar Segmento: ' . $model->seg_codsegmento;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Segmento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->seg_codsegmento];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="segmento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'eixo' => $eixo,
    ]) ?>

</div>
