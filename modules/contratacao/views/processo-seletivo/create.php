<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */

$this->title = 'Novo Processo Seletivo';
$this->params['breadcrumbs'][] = ['label' => 'Processos Seletivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-seletivo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cargos' => $cargos,
    ]) ?>

</div>
