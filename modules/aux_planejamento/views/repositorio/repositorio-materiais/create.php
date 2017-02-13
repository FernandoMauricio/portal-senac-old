<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Repositorio */

$this->title = 'Novo Material Didático';
$this->params['breadcrumbs'][] = ['label' => 'Materiais Didáticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repositorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoria' => $categoria,
        'editora' => $editora,
        'tipomaterial' => $tipomaterial,
    ]) ?>

</div>
