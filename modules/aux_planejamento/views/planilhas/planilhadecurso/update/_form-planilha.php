<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;

use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Planilhadecurso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planilhadecurso-form">

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 1: Informações do Plano</th></tr>
              </thead>
            </table>

        <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'nivelLabel')->textInput(['value'=> $model->nivel->niv_descricao,'readonly'=>true]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'eixoLabel')->textInput(['value'=> $model->eixo->eix_descricao,'readonly'=>true]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'segmentoLabel')->textInput(['value'=> $model->segmento->seg_descricao,'readonly'=>true]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'tipoAcaoLabel')->textInput(['value'=> $model->tipo->tip_descricao,'readonly'=>true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <?= $form->field($model, 'PlanoLabel')->textInput(['value'=> $model->plano->plan_descricao,'readonly'=>true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($model, 'placu_cargahorariaplano')->textInput(['readonly'=>true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($model, 'situacaoLabel')->textInput(['value'=> $model->situacaoPlani->sipla_descricao,'readonly'=>true]) ?>
                        </div>
                    </div>
        </div>

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 2: Sobre a Turma</th></tr>
              </thead>
            </table>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'anoLabel')->textInput(['value'=> $model->planilhaAno->an_ano,'readonly'=>true]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'categoriaLabel')->textInput(['value'=> $model->categoriaPlanilha->cat_descricao,'readonly'=>true]) ?>
                </div>

                <div class="col-md-2">
                    <?php
                            $rows = Tipoplanilha::find()->all();
                            $data_tipoplanilha = ArrayHelper::map($rows, 'tipla_codtipla', 'tipla_descricao');
                            echo $form->field($model, 'placu_codtipla')->widget(Select2::classname(), [
                                    'data' =>  $data_tipoplanilha,
                                    'options' => ['placeholder' => 'Tipo de Planilha...'],
                                    'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                    ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'tipoProgramacaoLabel')->textInput(['value'=> $model->tipoprogramacao->tipro_descricao,'readonly'=>true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_quantidadeturmas')->textInput() ?>
                </div>

            </div>

        <?= $form->field($model, 'placu_codtipoa')->hiddenInput()->label(false); ?>

        <?= $form->field($model, 'placu_codnivel')->hiddenInput()->label(false); ?>

        <?= $form->field($model, 'placu_cargahorariaplano')->hiddenInput()->label(false); ?>


            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'placu_cargahorariarealizada')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'placu_cargahorariaarealizar')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'placu_cargahorariavivencia')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'placu_quantidadealunos')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'placu_quantidadealunosisentos')->textInput() ?>
                </div>

                
            </div>

            <div class="col-md-12">
                   <?= $form->field($model, 'placu_observacao')->textarea(['rows' => 4]) ?>
            </div>

        </div>

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 4: Cálculos de Custos Indiretos</th></tr>
              </thead>
            </table>

                    <!-- Renderiza Despesas com Docente -->
                    <?= $this->render('_form-despesadocente', [
                        'form' => $form,
                        'modelsPlaniDespDocente' => $modelsPlaniDespDocente,
                    ]) ?>


    <div class="panel panel-default">
            <div class="panel-heading"> Resumo de Custos Diretos</div><br>
        <div class="panel-body">
            <div class="row">

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_totalcustodocente')->widget(\yii\widgets\MaskedInput::className(), [
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

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_decimo')->widget(\yii\widgets\MaskedInput::className(), [
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

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_ferias')->widget(\yii\widgets\MaskedInput::className(), [
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

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_tercoferias')->widget(\yii\widgets\MaskedInput::className(), [
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
                <div class="col-md-2">
                    <?= $form->field($model, 'placu_totalsalario')->widget(\yii\widgets\MaskedInput::className(), [
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
                <div class="col-md-2">
                    <?= $form->field($model, 'placu_totalencargos')->widget(\yii\widgets\MaskedInput::className(), [
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
                <div class="col-md-2">
                    <?= $form->field($model, 'placu_outdespvariaveis')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_totalsalarioPrestador')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_totalencargosPrestador')->widget(\yii\widgets\MaskedInput::className(), [
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
                
                <div class="col-md-4">
                    <?= $form->field($model, 'placu_totalsalarioencargo')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

            </div>

            <div class="row">

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_diarias')->textInput() ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_passagens')->textInput() ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'placu_equipamentos')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_pessoafisica')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_pessoajuridica')->textInput() ?>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_PJApostila')->widget(\yii\widgets\MaskedInput::className(), [
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

                    <?= $form->field($model, 'placu_hiddenpjapostila')->hiddenInput()->label(false); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_custosmateriais')->widget(\yii\widgets\MaskedInput::className(), [
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

                    <?= $form->field($model, 'placu_hiddenmaterialdidatico')->hiddenInput()->label(false); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_custosconsumo')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_custosaluno')->widget(\yii\widgets\MaskedInput::className(), [
                            'clientOptions' => [
                            'alias' => 'decimal',
                            'digits' => 2,
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            ],
                            'options' => ['readonly' => true, 'class' => 'form-control' ]
                    ]); ?>
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_totalcustodireto')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_totalhoraaulacustodireto')->widget(\yii\widgets\MaskedInput::className(), [
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
    </div>

        <table class="table table-condensed table-hover">
          <thead>
            <tr class="info"><th colspan="12">SEÇÃO 4: Cálculos de Custos Indiretos</th></tr>
          </thead>
        </table>

        <div class="panel panel-default">
            <div class="panel-heading"> Resumo de Custos Indiretos</div><br>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'placu_custosindiretos')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_ipca')->textInput() ?>
                </div>


                <div class="col-md-3">
                    <?= $form->field($model, 'placu_reservatecnica')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_despesadm')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_totalincidencias')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_totalcustoindireto')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_despesatotal')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_markdivisor')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_markmultiplicador')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_vendaturma')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_vendaaluno')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_retorno')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_horaaulaaluno')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_porcentretorno')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_precosugerido')->textInput() ?>
                </div>

                <div class="col-md-3">

                    <?= $form->field($model, 'placu_retornoprecosugerido')->widget(\yii\widgets\MaskedInput::className(), [
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
                    <?= $form->field($model, 'placu_minimoaluno')->textInput(['readonly' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'placu_parcelas')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'placu_valorparcelas')->widget(\yii\widgets\MaskedInput::className(), [
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
</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/planilhadecurso.js', ['position'=>$this::POS_READY]); ?>