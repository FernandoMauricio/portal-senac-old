<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Vestibular */

$this->title = 'Novo Vestiular';
$this->params['breadcrumbs'][] = ['label' => 'Vestibular', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vestibular-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
