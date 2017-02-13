<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Tipomaterial */

$this->title = 'Atualizar Tipo de Material: ' . $model->tip_codtipo;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Tipos de Materiais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tip_codtipo];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tipomaterial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'elementodespesa' => $elementodespesa,
    ]) ?>

</div>
