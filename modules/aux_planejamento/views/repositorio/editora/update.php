<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Editora */

$this->title = 'Atualizar Editora: ' . $model->edi_codeditora;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Editora', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->edi_codeditora];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="editora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
