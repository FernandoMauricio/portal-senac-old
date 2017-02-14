<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Comunicado */

$this->title = 'Inserir Comunicado: ' . $model->edital_id;
$this->params['breadcrumbs'][] = ['label' => 'Comunicados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comunicado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
