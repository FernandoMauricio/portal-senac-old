<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Aprovados */

$this->title = 'Atualizar Aprovados: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Aprovados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="aprovados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
