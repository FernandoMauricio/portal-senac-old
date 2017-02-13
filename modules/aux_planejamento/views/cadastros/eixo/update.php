<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Eixo */

$this->title = 'Atualizar Eixo: ' . $model->eix_codeixo;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Eixo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eix_codeixo];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="eixo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
