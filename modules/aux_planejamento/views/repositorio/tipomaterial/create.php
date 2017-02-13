<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Tipomaterial */

$this->title = 'Novo Tipo de Material';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Tipos de Materiais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomaterial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'elementodespesa' => $elementodespesa,
    ]) ?>

</div>
