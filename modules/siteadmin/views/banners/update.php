<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Banners */

$this->title = 'Atualização de Banners: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banners-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
