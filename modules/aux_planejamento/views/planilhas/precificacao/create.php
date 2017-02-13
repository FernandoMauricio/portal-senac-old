<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Precificacao */

$this->title = 'Nova Precificação de Custo';
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Precificação de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="precificacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'planos' => $planos,
        'unidades' => $unidades,
        'nivelDocente' => $nivelDocente,
    ]) ?>

</div>
