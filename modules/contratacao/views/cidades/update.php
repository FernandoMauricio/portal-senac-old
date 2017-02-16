<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cidades */

$this->title = 'Atualizar Cidade: ' . ' ' . $model->idcidade;
$this->params['breadcrumbs'][] = ['label' => 'Cidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcidade, 'url' => ['view', 'id' => $model->idcidade]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cidades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
