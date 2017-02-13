<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;

?>

<div class="panel panel-default">
                <table class="table"> 
                    <thead> 
                        <tr>    
                            <th>Código</th>
                            <th>Título</th>
                            <th>Identificação</th>
                            <th>Programado</th>
                            <th>Reforço (+) Redução (-)</th>
                            <th>Dotação Final</th>
                        </tr> 
                    </thead>
                        <?php foreach ($modelsDetalhesModeloA as $i => $modelDetalhesModeloA): ?>
                    <tbody> 
                        <tr class="default"> 

                                            <td style="width: 120px;"><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_codtitulo")->textInput(['readonly'=> true])->label(false); ?></td>

                                            <td><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_titulo")->textInput(['readonly'=> true])->label(false); ?></td>

                                            <td style="width: 20px;"><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_identificacao")->textInput(['readonly'=> true])->label(false); ?></td>


                                            <td style="width: 150px;"><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_programado")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => $model->moda_codentrada != 1 ?  true : false, 'class' => 'form-control']
                                                                                ])->label(false); ?></td>
                                            <td style="width: 150px;"><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_reforcoreducao")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => $model->moda_codentrada != 2 ?  true : false, 'class' => 'form-control']
                                                                                ])->label(false); ?></td>

                                            <th style="width: 150px;"><?= $form->field($modelDetalhesModeloA, "[{$i}]deta_dotacaofinal")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control','style'=> $modelDetalhesModeloA->deta_dotacaofinal < 0 ? 'color:red' : 'color:green']
                                                                                ])->label(false); ?> </th>

                        </tr> 
                                            <?= $form->field($modelDetalhesModeloA, "[{$i}]deta_codtipo")->hiddenInput()->label(false); ?>

                        <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <?php
                   //somatória das despesas do tipo 1
                   $query = (new \yii\db\Query())->from('db_apl2.detalhesmodeloa_deta')->where(['deta_codtipo' => 1, 'deta_codmodelo' => $model->moda_codmodelo]);
                   $despesascorrentes = $query->sum('deta_dotacaofinal');
               ?>
                  <th colspan="5" style="text-align: right;">Total Despesas de Correntes</th>
                   <th style="color:<?php echo $despesascorrentes < 0 ? 'red' : 'green' ?>"><?php echo 'R$ ' . number_format($despesascorrentes, 2, ',', '.') ?></th>
                </tr>
                <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <?php
                   //somatória das despesas do tipo 2
                   $query = (new \yii\db\Query())->from('db_apl2.detalhesmodeloa_deta')->where(['deta_codtipo' => 2, 'deta_codmodelo' => $model->moda_codmodelo]);
                   $despesascapital = $query->sum('deta_dotacaofinal');
               ?>
                  <th colspan="5" style="text-align: right;">Total Despesas de Capital</th>
                   <th style="color:<?php echo $despesascapital < 0 ? 'red' : 'green' ?>"><?php echo 'R$ ' . number_format($despesascapital, 2, ',', '.') ?></th>
                </tr>
                <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <?php
                   //somatória total das despesas
                   $query = (new \yii\db\Query())->from('db_apl2.detalhesmodeloa_deta')->where(['deta_codmodelo' => $model->moda_codmodelo]);
                   $deta_dotacaofinal = $query->sum('deta_dotacaofinal');
               ?>
                  <th colspan="5" style="text-align: right;">Total Dotação Final</th>
                   <th style="color:<?php echo $deta_dotacaofinal < 0 ? 'red' : 'green' ?>"><?php echo 'R$ ' .  number_format($deta_dotacaofinal, 2, ',', '.') ?></th>
                </tr>
            </tfoot> 
        </table>
</div>

<?php  $this->registerJsFile(Yii::$app->request->baseUrl.'/js/modeloa.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>