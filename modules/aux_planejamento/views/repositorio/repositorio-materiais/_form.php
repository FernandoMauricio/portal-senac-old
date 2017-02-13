<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\money\MaskMoney;
use kartik\widgets\FileInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Repositorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repositorio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'rep_titulo')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-2">
    <?php echo $form->field($model, 'rep_codmxm')->textInput() ?>
    </div>

    <div class="col-md-2">
    <?php echo $form->field($model, 'rep_qtdoriginais')->textInput() ?>
    </div>

    <div class="col-md-2">
    <?php echo $form->field($model, 'rep_valor')->widget(MaskMoney::classname());  ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?php
            $data_categoria = ArrayHelper::map($categoria, 'cat_descricao', 'cat_descricao');
            echo $form->field($model, 'rep_categoria')->widget(Select2::classname(), [
                    'data' =>  $data_categoria,
                    'options' => ['placeholder' => 'Selecione a categoria...'],
                    'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
        ?>
    </div>

    <div class="col-md-3">
        <?php
            $data_editora = ArrayHelper::map($editora, 'edi_descricao', 'edi_descricao');
            echo $form->field($model, 'rep_editora')->widget(Select2::classname(), [
                    'data' =>  $data_editora,
                    'options' => ['placeholder' => 'Selecione a editora...'],
                    'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
        ?>
    </div>

    <div class="col-md-3">
        <?php
            $data_tipo = ArrayHelper::map($tipomaterial, 'tip_descricao', 'tip_descricao');
            echo $form->field($model, 'rep_tipo')->widget(Select2::classname(), [
                    'data' =>  $data_tipo,
                    'options' => ['id' => 'tipomaterial-id','placeholder' => 'Selecione o tipo de Material...',
                    'onchange'=>'
                                var select = this;
                                $.getJSON( "'.Url::toRoute('/aux_planejamento/repositorio/repositorio-materiais/get-tipo-material').'", { tipmatId: $(this).val() } )
                                .done(function( data ) {

                                       var $divPanelBody = $(select).parent().parent().parent().parent().parent();

                                       var $inputDescricao = $divPanelBody.find("input:eq(6)");
                                       
                                       $inputDescricao.val(data.tip_elementodespesa_id);
                                       
                                    });
                                '
                          ]]);
        ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'rep_elementodespesa')->textInput(['readonly' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'rep_sobre')->textarea(['rows' => 4]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
          <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                   // 'options' => ['accept' => 'image/*'],
                   'language' => 'pt',
                   'pluginOptions'=>['allowedFileExtensions'=>['pdf', 'zip', 'rar', 'doc', 'docx'],'showUpload' => false,
                   'initialPreview' => [
                    $model->rep_arquivo,
                    ],

                ],
              ]);   ?>
    </div>

    <div class="col-md-6">
          <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                  'options' => ['accept' => 'image/*'], 'language' => 'pt',
                   'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,
                   'initialPreview' => [
                    $model->rep_image_web_filename ? Html::img(Yii::$app->request->baseUrl. '/uploads/repositorio/capas/' . $model->rep_image_web_filename) : null, 
                    ]
                ],
              ]);   ?>
    </div>
 </div>

<div class="row">
    <div class="col-md-12">
    <?= $form->field($model, 'rep_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>
    </div>
</div>

  </div>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


