<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */

$this->title = 'Atualizar Solicitação de Contratação: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitação de Contratação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id,];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="contratacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sistemas' => $sistemas,
        
    ]) ?>

</div>
