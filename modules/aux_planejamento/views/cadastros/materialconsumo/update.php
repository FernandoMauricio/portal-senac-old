<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialconsumo */

$this->title = 'Atualizar Material de Consumo: ' . $model->matcon_codMXM;
$this->params['breadcrumbs'][] = ['label' => 'Materiais de Consumo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matcon_codMXM];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="materialconsumo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipounidade' => $tipounidade,
    ]) ?>

</div>
