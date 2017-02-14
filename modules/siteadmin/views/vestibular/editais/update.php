<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Editais */

$this->title = 'Atualizar Edital: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Editais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="editais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
