<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoMaterial */

$this->title = 'Create Plano Material';
$this->params['breadcrumbs'][] = ['label' => 'Plano Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'planoMaterial' => $planoMaterial,
    ]) ?>

</div>
