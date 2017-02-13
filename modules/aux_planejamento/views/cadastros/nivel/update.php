<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Nivel */

$this->title = 'Atualizar Nivel: ' . $model->niv_codnivel;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Nivel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->niv_codnivel];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="nivel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
