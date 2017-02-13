<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Custosunidade */

$this->title = 'Novo Custos da Unidade';
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Custos da Unidade', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custosunidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'unidades' => $unidades,
        'salas' => $salas,
        'modelsCustosIndireto'  => $modelsCustosIndireto,
    ]) ?>

</div>
