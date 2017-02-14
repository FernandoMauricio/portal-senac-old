<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Editais */

$this->title = 'Inserir Edital - Vestibular #' . $model->vestibular_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Editais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="editais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
