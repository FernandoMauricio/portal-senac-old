<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Salas */

$this->title = 'Atualizar Sala: ' . $model->sal_codsala;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sal_codsala, 'url' => ['view', 'id' => $model->sal_codsala]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="salas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
