<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Vestibular */

$this->title = 'Atualizar Vestibular: ' . ' ' . $model->idVest;
$this->params['breadcrumbs'][] = ['label' => 'Vestibular', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idVest, 'url' => ['view', 'id' => $model->idVest]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="vestibular-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
