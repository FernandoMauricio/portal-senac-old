<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Aprovados */

$this->title = 'Inserir Aprovados - Vestibular #' . $model->vestibular_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Aprovados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aprovados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
