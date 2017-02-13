<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Ano */

$this->title = 'Atualizar Ano: ' . $model->an_codano;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Ano', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->an_codano];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="ano-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
