<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Markup */

$this->title = 'Configuração Markup ';
$this->params['breadcrumbs'][] = ['label' => 'Markup'];
$this->params['breadcrumbs'][] = 'Configuração Markup';
?>
<div class="markup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'dataProvider' => $dataProvider,
    ]) ?>

</div>
