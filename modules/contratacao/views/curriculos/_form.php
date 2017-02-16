<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\datecontrol\DateControl;
use wbraganca\dynamicform\DynamicFormWidget;

 
/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-endereco-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
        

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Cadastros de Curriculos</h3>
  </div>
  <div class="panel-body">
                            <?php echo $form->errorSummary($model); ?>    
        <div class="span12">
            <section id="wizard">

                <div id="rootwizard" class="tabbable tabs-left">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Candidato</a></li>
                        <li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Endereço</a></li>
                        <li><a href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-education"></span> Formação Escolar</a></li>
                        <li><a href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> Cursos Complementares</a></li>
                        <li><a href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-briefcase"></span> Empregos Anteriroes</a></li>
                    </ul>

                 <div class="tab-content">

                  <!--            INFORMAÇÕES DO CANDIDATO                -->

                        <div class="tab-pane" id="tab1">
                    <?php
                    echo $this->render('_form-candidato', [
                        'form' => $form,
                        'model' => $model,
                        'cargos' => $cargos,
                    ])
                    ?>
                 </div>


            <!--            ENDEREÇO                -->

                    <div class="tab-pane" id="tab2">
                    <?php
                    echo $this->render('_form-endereco', [
                        'form' => $form,
                        'curriculosEndereco' => $curriculosEndereco,
                    ])
                    ?>
                    </div>

                    <!--         FORMAÇÃO       -->

                    <div class="tab-pane" id="tab3">
                    <?php
                    echo $this->render('_form-formacao', [
                        'form' => $form,
                        'curriculosFormacao' => $curriculosFormacao,
                    ])
                    ?>
                    </div>


                    <!--        CURSOS COMPLEMENTARES      -->

                        <div class="tab-pane" id="tab4">
                            <div class="row">
                     <?php
                     echo $this->render('_form-complemento', [
                        'form' => $form,
                        'modelsComplemento' => $modelsComplemento,
                        ])
                        ?>
                            </div>
                        </div>


                                <!--        EMPREGOS ANTERIORES      -->

                        <div class="tab-pane" id="tab5">
                             <div class="row">
                        <?php
                        echo $this->render('_form-empregos', [
                        'form' => $form,
                        'modelsEmpregos' => $modelsEmpregos,
                        ])
                        ?>
                             </div>


 <?php echo $form->field($model, 'termoAceite[]')->checkboxList([ 1 => 'Li o Documento de Abertura e concordo em participar do processo de seleção desta instituição de acordo com o que foi estabelecido e proposto pelo mesmo.']); ?>


                             <!-- SUBMIT PARA ENVIAR O CURRICULO SE TODOS OS CAMPOS COM VALIDAÇÕES TIVEREM SIDO PREENCHIDOS-->
                            <?= Html::submitButton($model->isNewRecord ? 'Finalizar Cadastro de Currículo' : 'Finalizar Cadastro de Currículo', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
                        </div>



                        <!-- BOTÕES PARA NAVEGAR ENTRE OS FORMULÁRIOS-->
                        <ul class="pager wizard">
                            <li class="previous"><a href="#">Anterior</a></li>
                            <li class="next"><a href="#">Próximo</a></li>
                        </ul>
                 </div>  


                </div>


      </div>
    </div>

 <?php ActiveForm::end(); ?>


            <!--          JS etapas dos formularios            -->
<?php
$script = <<< JS
$(document).ready(function() {
    $('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-tabs'});
});


JS;
$this->registerJs($script);
?>


<?php
 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/bootstrap.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.bootstrap.wizard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>