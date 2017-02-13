<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\TransporteAdminAcompanhamento */

$this->title = 'Create Transporte Admin Acompanhamento';
$this->params['breadcrumbs'][] = ['label' => 'Transporte Admin Acompanhamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-admin-acompanhamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
