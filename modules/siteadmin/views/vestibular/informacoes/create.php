<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Informacoes */

$this->title = 'Inserir Informação - Vestibular #' . $model->vestibular_id;
$this->params['breadcrumbs'][] = ['label' => 'Informações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informacoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
