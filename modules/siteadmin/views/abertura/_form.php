<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\siteadmin\models\Unidades;
use app\modules\siteadmin\models\Status;
use app\modules\siteadmin\models\Situacao;
use kartik\select2\Select2;
use kartik\file\FileInput;



/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Abertura */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="abertura-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'desc_abertura')->textInput(['maxlength' => true]) ?>

    <?php

    echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => '.pdf'],
        'language' => 'pt',
        'pluginOptions' => [
        'showRemove'=> false,
        'showUpload'=> false,
        // 'initialPreview'=>[
        //     Html::img("../web/uploads/siteadmin/psg/pdf.png", ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
        //     ],

        'initialCaption'=>$model->arquivo,
        ],
    ]);


    ?>


    <?php
                 
                $rows = Situacao::find()->all();
                $data_situacao = ArrayHelper::map($rows, 'id', 'descricao');
                echo $form->field($model, 'estado_id')->widget(Select2::classname(), [
                    'data' => $data_situacao,
                    'options' => ['placeholder' => 'Selecione a Situação...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])
    ?> 



    <?php

                //UNIDADES
                echo $form->field($model, 'unidades')->widget(Select2::classname(), [
                    'model' => $model,
                    'attribute' => 'unidades',
                    'data' => ["Senac Centro" => "Senac Centro", "Centro de Informática" => "Centro de Informática", "Senac Cidade Nova" => "Senac Cidade Nova", "Faculdade de Tecnologia do Senac" => "Faculdade de Tecnologia do Senac","Senac Manacapuru" => "Senac Manacapuru", "Senac Itacoatiara" => "Senac Itacoatiara", "Senac Coari" => "Senac Coari", "Senac Tefé" => "Senac Tefé", "Senac Parintins" => "Senac Parintins",
                    "Carreta de Hospitalidade" => "Carreta de Hospitalidade", "Carreta de Beleza" => "Carreta de Beleza", "Carreta de Informática" => "Carreta de Informática", "Unidade Fluvial - Balsa Escola" => "Unidade Fluvial - Balsa Escola" ],
                    'options' => ['placeholder' => 'Selecione a Localidade ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);    

    ?> 

        <?php
                 
                $rows = Status::find()->all();
                $data = ArrayHelper::map($rows, 'id', 'descricao');
                echo $form->field($model, 'status_id')->widget(Select2::classname(), [
                    'data' => $data,
                    'options' => ['placeholder' => 'Selecione o Estado ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
    ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
