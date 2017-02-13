<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Markup */

$this->title = 'Create Markup';
$this->params['breadcrumbs'][] = ['label' => 'Markups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="markup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
