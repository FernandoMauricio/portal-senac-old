<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use kartik\money\MaskMoney;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
use yii\widgets\MaskedInput;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Cursos */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>


<div class="cursos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">

    <div class="col-md-4">

    <?= $form->field($model, 'nome_curso')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="col-md-4">

        <?php echo FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Selecione o Início e Fim do curso',
            'attribute1' => 'data_inicial',
            'attribute2' => 'data_final',
            'type' => FieldRange::INPUT_DATE,
            'widgetOptions1' => [
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'php:d/m/Y',
                    ]
                ],
        ]); 
        ?>

    </div>

    <div class="col-md-4">

       <?php echo FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Selecione o horário',
            'attribute1' => 'hora_inicial',
            'attribute2' => 'hora_final',
            'type' => FieldRange::INPUT_TIME,
            'widgetOptions1' => [
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                    ]
                ],
            'widgetOptions2' => [
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                    ]
                ],
        ]); 
        ?>

    </div>
  </div>
     
<div class="row">
    <div class="col-md-4">
        <?php
            // echo '<label class="control-label">Unidade</label>';
            // echo Select2::widget([
            //     'model' => $model,
            //     'attribute' => 'unidade_curso',
            //     'data' => ["Senac Centro" => "Senac Centro", "Centro de Informática" => "Centro de Informática", "Senac Cidade Nova" => "Senac Cidade Nova", "Faculdade de Tecnologia do Senac" => "Faculdade de Tecnologia do Senac","Senac Manacapuru" => "Senac Manacapuru", "Senac Itacoatiara" => "Senac Itacoatiara", "Senac Coari" => "Senac Coari", "Senac Tefé" => "Senac Tefé", "Senac Parintins" => "Senac Parintins"],
            //     'options' => ['placeholder' => 'Selecione a Unidade ...'],
            //     'pluginOptions' => [
            //         'allowClear' => true
            //     ],
            // ]);                  
        ?> 

        <?php
                $data_unidades = ArrayHelper::map($unidades, 'id', 'uni_descricao');
                echo $form->field($model, 'unidade_id')->widget(Select2::classname(), [
                        'data' =>  $data_unidades,
                        'options' => ['placeholder' => 'Selecione a Unidade...'],
                        'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
        ?>
    </div>

        <div class="col-md-4">
        <?php

        echo $form->field($model, 'parcelamento')->widget(Select2::classname(), [
            'data' =>["1x" => "1x", "2x" => "2x", "3x" => "3x", "4x" => "4x", "5x" => "5x", "6x" => "6x"],
            'options' => ['placeholder' => 'Selecione o parcelamento ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>

        </div>

        <div class="col-md-4">

        <?php
        echo $form->field($model, 'investimento')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => 'R$ ',
                'suffix' => '',
                'allowNegative' => false
            ]
        ]);

        ?>
        </div>
    </div>

<div class="row">
    <div class="col-md-6">

     <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>
        </div>

    <div class="col-md-6">

    <?php    
    echo $form->field($model, 'link')->textInput() ?>

        </div>

    </div>

<div class="row">
    <div class="col-md-12">

          <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                  'options' => ['accept' => 'image/*'], 'language' => 'pt',
                   'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,
                   'initialPreview' => [
                    $model->nome ? Html::img($model->nome) : null, 
                    ]
                ],
              ]);   ?>

        </div>
    </div>

        <div class="form-group">
            <?= Html::submitButton('Atualizar', ['class' =>'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
