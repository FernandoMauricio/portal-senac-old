<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Editora */

$this->title = 'Nova Editora';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Editora', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="editora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
