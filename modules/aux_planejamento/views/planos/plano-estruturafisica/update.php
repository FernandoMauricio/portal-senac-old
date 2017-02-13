<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoEstruturafisica */

$this->title = 'Update Plano Estruturafisica: ' . $model->planestr_cod;
$this->params['breadcrumbs'][] = ['label' => 'Plano Estruturafisicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->planestr_cod, 'url' => ['view', 'id' => $model->planestr_cod]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plano-estruturafisica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
