<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\comunicacaointerna\models\Cargos */

$this->title = 'Create Cargos';
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
