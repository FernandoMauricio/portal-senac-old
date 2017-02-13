<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Repositorio */

$this->title = 'Atualizar Material Didático: ' . $model->rep_codrepositorio;
$this->params['breadcrumbs'][] = ['label' => 'Materiais Didáticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_codrepositorio];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="repositorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoria' => $categoria,
        'editora' => $editora,
        'tipomaterial' => $tipomaterial,
    ]) ?>

</div>
