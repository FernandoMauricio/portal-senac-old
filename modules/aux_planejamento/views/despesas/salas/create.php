<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Salas */

$this->title = 'Nova Sala';
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
