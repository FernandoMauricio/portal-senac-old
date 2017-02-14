<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Abertura */

$this->title = 'Nova Abertura de Vagas';
$this->params['breadcrumbs'][] = ['label' => 'Abertura de Vagas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abertura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
