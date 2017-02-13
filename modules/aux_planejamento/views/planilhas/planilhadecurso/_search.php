<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\PlanilhadecursoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planilhadecurso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'placu_codplanilha') ?>

    <?= $form->field($model, 'placu_codeixo') ?>

    <?= $form->field($model, 'placu_codsegmento') ?>

    <?= $form->field($model, 'placu_codplano') ?>

    <?= $form->field($model, 'placu_codtipoa') ?>

    <?php // echo $form->field($model, 'placu_codnivel') ?>

    <?php // echo $form->field($model, 'placu_cargahorariaplano') ?>

    <?php // echo $form->field($model, 'placu_cargahorariarealizada') ?>

    <?php // echo $form->field($model, 'placu_cargahorariaarealizar') ?>

    <?php // echo $form->field($model, 'placu_codano') ?>

    <?php // echo $form->field($model, 'placu_codfinalidade') ?>

    <?php // echo $form->field($model, 'placu_codcategoria') ?>

    <?php // echo $form->field($model, 'placu_codtipla') ?>

    <?php // echo $form->field($model, 'placu_quantidadeturmas') ?>

    <?php // echo $form->field($model, 'placu_quantidadealunos') ?>

    <?php // echo $form->field($model, 'placu_codsituacao') ?>

    <?php // echo $form->field($model, 'placu_codcolaborador') ?>

    <?php // echo $form->field($model, 'placu_codunidade') ?>

    <?php // echo $form->field($model, 'placu_nomeunidade') ?>

    <?php // echo $form->field($model, 'placu_quantidadealunospsg') ?>

    <?php // echo $form->field($model, 'placu_arquivolistamaterial') ?>

    <?php // echo $form->field($model, 'placu_listamaterialdoaluno') ?>

    <?php // echo $form->field($model, 'placu_observacao') ?>

    <?php // echo $form->field($model, 'placu_cargahorariavivencia') ?>

    <?php // echo $form->field($model, 'placu_quantidadealunosisentos') ?>

    <?php // echo $form->field($model, 'planilhadecurso_placucol') ?>

    <?php // echo $form->field($model, 'placu_codprogramacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
