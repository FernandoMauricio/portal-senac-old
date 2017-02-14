<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Errata */

$this->title = 'Inserir Errata #' . $model->edital_id;
$this->params['breadcrumbs'][] = ['label' => 'Erratas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="errata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
