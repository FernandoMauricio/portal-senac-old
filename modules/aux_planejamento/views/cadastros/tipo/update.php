<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Tipo */

$this->title = 'Atualizar Tipo de Ação: ' . $model->tip_codtipoa;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Tipos de Ação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tip_codtipoa];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
