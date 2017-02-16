<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */

$this->title = 'Create Contratacao';
$this->params['breadcrumbs'][] = ['label' => 'Contratacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

