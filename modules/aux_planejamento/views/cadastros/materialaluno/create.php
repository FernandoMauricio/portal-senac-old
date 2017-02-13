<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialaluno */

$this->title = 'Novo Material do Aluno';
$this->params['breadcrumbs'][] = ['label' => 'Materiais do Aluno', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialaluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipounidade' => $tipounidade,
    ]) ?>

</div>
