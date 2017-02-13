<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Precificacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="precificacao-form">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Nova Precificação de Custo</h3>
          </div>
            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 1: Informações do Curso</th></tr>
              </thead>
            </table>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?php
                        $data_unidades = ArrayHelper::map($unidades, 'uni_codunidade', 'uni_nomeabreviado');
                        echo $form->field($model, 'planp_codunidade')->widget(Select2::classname(), [
                                'data' =>  $data_unidades,
                                'options' => ['id' => 'unidade-id','placeholder' => 'Selecione a Unidade...',
                                'onchange'=>'
                                      var select = this;
                                      $.getJSON( "'.Url::toRoute('/aux_planejamento/planilhas/precificacao/get-markup').'", { markup: $(this).val() } )
                                      .done(function( data ) {

                                             var $divPanelBody = $(select).parent().parent().parent().parent().parent();

                                             var $zerahora = $divPanelBody.find("input:eq(2)");
                                             var $inputCustoIndireto   = $divPanelBody.find("input:eq(26)");
                                             var $inputIPCA            = $divPanelBody.find("input:eq(27)");
                                             var $inputReservaTecnica  = $divPanelBody.find("input:eq(28)");
                                             var $inputDespesaSede     = $divPanelBody.find("input:eq(29)");

                                             $zerahora.val(0);
                                             $inputCustoIndireto.val(data.mark_custoindireto);
                                             $inputIPCA.val(data.mark_ipca);
                                             $inputReservaTecnica.val(data.mark_reservatecnica);
                                             $inputDespesaSede.val(data.mark_despesasede);

                                          });
                                      '
                                ]]);
                ?>
                </div>

                <div class="col-md-4">
                    <?php
                        $data_planos = ArrayHelper::map($planos, 'plan_codplano', 'plan_descricao');
                        echo $form->field($model, 'planp_planodeacao')->widget(Select2::classname(), [
                                'data' =>  $data_planos,
                                'options' => ['id' => 'plano-id','placeholder' => 'Selecione o Curso...',
                                'onchange'=>'
                                      var select = this;
                                      $.getJSON( "'.Url::toRoute('/aux_planejamento/planilhas/precificacao/get-plano').'", { plano: $(this).val() } )
                                      .done(function( data ) {

                                             var $divPanelBody = $(select).parent().parent().parent().parent().parent();

                                             var $zerahoratotal            = $divPanelBody.find("input:eq(0)");
                                             var $zeraqntaluno             = $divPanelBody.find("input:eq(1)");
                                             var $inputMaterialApostila    = $divPanelBody.find("input:eq(20)");
                                             var $inputCustoMaterialLivro  = $divPanelBody.find("input:eq(22)");
                                             var $inputCustoConsumo        = $divPanelBody.find("input:eq(23)");

                                             $zerahoratotal.val(data.plan_cargahoraria);
                                             $zeraqntaluno.val(0);
                                             $inputMaterialApostila.val(data.plan_custoMaterialApostila);
                                             $inputCustoMaterialLivro.val(data.plan_custoMaterialLivro);
                                             $inputCustoConsumo.val(data.plan_custoTotalConsumo);

                                          });
                                      '
                                ]]);
                ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'planp_cargahoraria')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'planp_qntaluno')->textInput() ?>
                </div>

            </div>
        </div>

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 2: Cálculos de Custos Diretos</th></tr>
              </thead>
            </table>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <?php
                            $data_nivelDocente = ArrayHelper::map($nivelDocente, 'doce_id', 'doce_descricao');
                            echo $form->field($model, 'planp_docente')->widget(Select2::classname(), [
                                'data' =>  $data_nivelDocente,
                                'options' => ['id' => 'nivelDocente-id','placeholder' => 'Selecione o Nível do Docente...',
                                'onchange'=>'
                                      var select = this;
                                      $.getJSON( "'.Url::toRoute('/aux_planejamento/planilhas/precificacao/get-nivel-docente').'", { niveldocente: $(this).val() } )
                                      .done(function( data ) {

                                             var $divPanelBody = $(select).parent().parent().parent().parent().parent();

                                             var $zerahora = $divPanelBody.find("input:eq(2)");
                                             var $zeraplanejmanento = $divPanelBody.find("input:eq(3)");
                                             var $inputPlanejamento = $divPanelBody.find("input:eq(4)");
                                             var $inputCustoindireto = $divPanelBody.find("input:eq(5)");

                                             //inputa valores
                                             $zerahora.val(0);
                                             $zeraplanejmanento.val(0);
                                             $inputCustoindireto.val(data.doce_valorhoraaula);
                                             $inputPlanejamento.val(data.doce_planejamento);

                                          });
                                      '
                                ]]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'planp_totalhorasdocente')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'planp_servpedagogico')->textInput() ?>

                    <?= $form->field($model, 'hiddenPlanejamento')->hiddenInput()->label(false); ?>
                </div>

            </div>


            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_valorhoraaula')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_horaaulaplanejamento')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'planp_totalcustodocente')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_decimo')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_ferias')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_tercoferias')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalsalario')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_encargos')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['value'=> 32.7, 'readonly' => true, 'class' => 'form-control' ]
                    ]); ?>

                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalencargos')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control']
                    ]); ?>

                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'planp_totalsalarioencargo')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_diarias')->textInput(['value' => 0]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_passagens')->textInput(['value' => 0]) ?>
                </div>


                <div class="col-md-3">
                    <?= $form->field($model, 'planp_pessoafisica')->textInput(['value' => 0]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_pessoajuridica')->textInput(['value' => 0]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_PJApostila')->textInput(['readonly' => true]); ?>

                    <?= $form->field($model, 'hiddenPJApostila')->hiddenInput()->label(false); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_custosmateriais')->textInput(['readonly' => true]); ?>

                    <?= $form->field($model, 'hiddenMaterialDidatico')->hiddenInput()->label(false); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_custosconsumo')->textInput(['readonly' => true]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalcustodireto')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalhoraaulacustodireto')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 3,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>
        </div>

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 3: Cálculos de Custos Indiretos</th></tr>
              </thead>
            </table>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_custosindiretos')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_ipca')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_reservatecnica')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_despesadm')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalincidencias')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_totalcustoindireto')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'planp_despesatotal')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_markdivisor')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_markmultiplicador')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'planp_vendaturma')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_vendaaluno')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_retorno')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_horaaulaaluno')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_porcentretorno')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'suffix' => '%',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_precosugerido')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_retornoprecosugerido')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'planp_minimoaluno')->textInput(['readonly' => true]) ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'planp_parcelas')->textInput() ?>
                </div>

                <div class="col-md-3">

                    <?= $form->field($model, 'planp_valorparcelas')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 0,
                            'prefix' => 'R$ ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/precificacao.js', ['position'=>$this::POS_READY]); ?>
