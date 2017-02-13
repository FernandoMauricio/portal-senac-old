<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\TransporteAdminEncerradas */

$this->title = 'Create Transporte Admin Encerradas';
$this->params['breadcrumbs'][] = ['label' => 'Transporte Admin Encerradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-admin-encerradas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
