<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Classificados */

$this->title = 'Inserir Listagem de Classificados #' . $model->edital_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Classificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classificados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
