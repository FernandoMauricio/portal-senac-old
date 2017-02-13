<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Estruturafisica */

$this->title = 'Atualizar Equipamentos / Utensílios: ' . $model->estr_cod;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Equipamentos / Utensílios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->estr_cod];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="estruturafisica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
