<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoEstruturafisica */

$this->title = 'Create Plano Estruturafisica';
$this->params['breadcrumbs'][] = ['label' => 'Plano Estruturafisicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-estruturafisica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
