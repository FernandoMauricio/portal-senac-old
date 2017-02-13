<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Estruturafisica */

$this->title = 'Novo Equipamentos / Utensílios';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Equipamentos / Utensílios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estruturafisica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
