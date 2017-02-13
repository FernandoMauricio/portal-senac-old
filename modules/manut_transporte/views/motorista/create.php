<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Motorista */

$this->title = 'Create Motorista';
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
