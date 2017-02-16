<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */

$this->title = 'Nova Contratação';
$this->params['breadcrumbs'][] = ['label' => 'Solicitação de Contratação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sistemas' => $sistemas,
    ]) ?>

</div>
