<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\PlanilhaJustificativas */

?>
<div class="planilha-justificativas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
