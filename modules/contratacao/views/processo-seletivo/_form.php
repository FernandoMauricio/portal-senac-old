<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use \kartik\form\ActiveForm;
use app\modules\contratacao\models\Situacao;
use app\modules\contratacao\models\Modalidade;
use app\modules\contratacao\models\Status;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="processo-seletivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numeroEdital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo')->textarea(['rows' => 6]) ?>

    <?php

            echo $form->field($model, 'data')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);

    ?>

        <?php

            echo $form->field($model, 'data_encer')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);
    ?>

    <?php

            $rows = Modalidade::find()->all();
            $data_modalidade = ArrayHelper::map($rows, 'id', 'descricao');
            echo $form->field($model, 'modalidade_id')->radiolist($data_modalidade);
 
    ?>


    <?php

            $rows = Situacao::find()->all();
            $data_situacao = ArrayHelper::map($rows, 'id', 'descricao');
            echo $form->field($model, 'situacao_id')->radiolist($data_situacao);
 
    ?>



    <?= $form->field($model, 'status_id')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>


    <?php 
    $options = \yii\helpers\ArrayHelper::map($cargos, 'idcargo', 'descricao');
    echo $form->field($model, 'permissions')->checkboxList($options, ['unselect'=>NULL]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Processo Seletivo' : 'Atualizar Processo Seletivo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
