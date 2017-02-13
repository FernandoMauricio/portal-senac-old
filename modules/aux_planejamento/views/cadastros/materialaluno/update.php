<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialaluno */

$this->title = 'Atualizar Material do Aluno: ' . $model->matalu_cod;
$this->params['breadcrumbs'][] = ['label' => 'Materiais do Aluno', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matalu_cod];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="materialaluno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipounidade' => $tipounidade,
    ]) ?>

</div>
