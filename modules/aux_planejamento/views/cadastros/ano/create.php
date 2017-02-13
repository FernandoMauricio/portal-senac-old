<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Ano */

$this->title = 'Novo Ano';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Ano', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ano-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
