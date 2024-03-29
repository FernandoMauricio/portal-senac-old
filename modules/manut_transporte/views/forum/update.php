<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Forum */

$this->title = 'Update Forum: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'forum' => $forum,
    ]) ?>

</div>
