<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Categoria */

$this->title = 'Atualizar Categoria: ' . $model->cat_codcategoria;
$this->params['breadcrumbs'][] = ['label' => 'Cadastro de Categoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_codcategoria];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
