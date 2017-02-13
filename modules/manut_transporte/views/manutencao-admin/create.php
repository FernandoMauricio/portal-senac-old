<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdmin */

$this->title = 'Create Manutencao Admin';
$this->params['breadcrumbs'][] = ['label' => 'Manutencao Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
