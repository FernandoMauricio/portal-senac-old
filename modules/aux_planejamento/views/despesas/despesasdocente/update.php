<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Despesasdocente */

$this->title = 'Atualizar Despesa com Docente: ' . $model->doce_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Despesas com Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doce_id];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="despesasdocente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
