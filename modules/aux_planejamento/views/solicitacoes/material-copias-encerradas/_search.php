<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\solicitacoes\MaterialCopiasEncerradasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-copias-encerradas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'matc_id') ?>

    <?= $form->field($model, 'matc_qtoriginais') ?>

    <?= $form->field($model, 'matc_qtexemplares') ?>

    <?= $form->field($model, 'matc_mono') ?>

    <?php // echo $form->field($model, 'matc_color') ?>

    <?php // echo $form->field($model, 'matc_curso') ?>

    <?php // echo $form->field($model, 'matc_centrocusto') ?>

    <?php // echo $form->field($model, 'matc_unidade') ?>

    <?php // echo $form->field($model, 'matc_solicitante') ?>

    <?php // echo $form->field($model, 'matc_data') ?>

    <?php // echo $form->field($model, 'situacao_id') ?>

    <?php // echo $form->field($model, 'matc_qteCopias') ?>

    <?php // echo $form->field($model, 'matc_qteTotal') ?>

    <?php // echo $form->field($model, 'matc_totalValorMono') ?>

    <?php // echo $form->field($model, 'matc_totalValorColor') ?>

    <?php // echo $form->field($model, 'matc_ResponsavelAut') ?>

    <?php // echo $form->field($model, 'matc_dataAut') ?>

    <?php // echo $form->field($model, 'matc_autorizado') ?>

    <?php // echo $form->field($model, 'matc_ResponsavelRepro') ?>

    <?php // echo $form->field($model, 'matc_dataRepro') ?>

    <?php // echo $form->field($model, 'matc_encaminhadoRepro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
