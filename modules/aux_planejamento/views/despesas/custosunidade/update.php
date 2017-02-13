<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Custosunidade */

$this->title = 'Atualizar Custos da Unidade: ' . $model->cust_codcusto;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Custos da Unidade', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cust_codcusto, 'url' => ['view', 'id' => $model->cust_codcusto]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="custosunidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'unidades' => $unidades,
        'salas' => $salas,
        'modelsCustosIndireto'  => $modelsCustosIndireto,
    ]) ?>

</div>
