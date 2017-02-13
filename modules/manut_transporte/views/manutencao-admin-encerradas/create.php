<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdminEncerradas */

$this->title = 'Create Manutencao Admin Encerradas';
$this->params['breadcrumbs'][] = ['label' => 'Manutencao Admin Encerradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-admin-encerradas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
