<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\FichasInscricoes */

$this->title = 'Inserir Fichas de Inscrição - Vestibular #' . $model->vestibular_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Fichas de Inscrições', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichas-inscricoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
