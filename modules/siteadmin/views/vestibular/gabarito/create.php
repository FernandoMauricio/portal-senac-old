<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Gabarito */

$this->title = 'Inserir Gabarito - Vestibular #' . $model->vestibular_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Gabaritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gabarito-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
