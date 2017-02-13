<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialconsumo */

$this->title = 'Novo Material de Consumo';
$this->params['breadcrumbs'][] = ['label' => 'Materiais de Consumo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialconsumo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipounidade' => $tipounidade,
    ]) ?>

</div>