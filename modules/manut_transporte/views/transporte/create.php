<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Transporte */

$this->title = 'Solicitação de Transporte';
$this->params['breadcrumbs'][] = ['label' => 'Transportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bairros'=> $bairros,
        'tipoCarga'=>$tipoCarga,
    ]) ?>

</div>
