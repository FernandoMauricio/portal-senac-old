<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;
use app\modules\aux_planejamento\models\cadastros\Tipo;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planos\PlanodeacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Planilhas - Administrador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilhadecurso-admin-index">

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Enviar Planejamento', ['value'=> Url::to('index.php?r=aux_planejamento/planilhas/planilhadecurso-admin/enviar-planejamento-admin'), 'class' => 'btn btn-warning', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Defina a unidade a ser enviada o Planejamento:</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
   ?>

<?php Pjax::begin(); ?>    

<?php echo  GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'pjax'=>true,
            'striped'=>true,
            'hover'=>true,
            'panel'=>['type'=>'primary', 'heading'=>'Listagem de Planilhas de Curso'],
            'columns'=>[
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'placu_codsegmento', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->segmento->seg_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Segmento::find()->orderBy('seg_descricao')->asArray()->all(), 'seg_codsegmento', 'seg_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione o Segmento'],
                'group'=>true,  // enable grouping
                'groupHeader'=>function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns'=>[[1, 3]], // columns to merge in summary
                        'content'=>[             // content to show in each summary cell
                            1=> $model->eixo->eix_descricao,
                        ],
                        // html attributes for group summary row
                        'options'=>['class'=>'info','style'=>'font-weight:bold;']
                    ];
                }
            ],

            [
                'attribute'=>'placu_codtipoa', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipo->tip_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tipo::find()->orderBy('tip_descricao')->asArray()->all(), 'tip_codtipoa', 'tip_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione o Tipo de Ação'],
                'group'=>true,  // enable grouping
                'subGroupOf'=>1, // supplier column index is the parent group,
            ],

            [
              'attribute'=>'anoLabel',
              'value'=> 'planilhaAno.an_ano',
            ],

            [
                'attribute'=>'placu_nomeunidade', 
                'width'=>'350px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->unidade->uni_nomeabreviado;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Unidade::find()->orderBy('uni_nomeabreviado')->asArray()->all(), 'uni_nomeabreviado', 'uni_nomeabreviado'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
            ],
            
            'placu_codplanilha',

            [
              'attribute'=>'PlanoLabel',
              'value'=> 'plano.plan_descricao',
            ],

            [
                'attribute'=>'placu_codtipla', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoplanilha->tipla_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tipoplanilha::find()->orderBy('tipla_descricao')->asArray()->all(), 'tipla_codtipla', 'tipla_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipo de Planilha'],
            ],

            [
                'attribute'=>'placu_codprogramacao', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoprogramacao->tipro_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tipoprogramacao::find()->orderBy('tipro_descricao')->asArray()->all(), 'tipro_codprogramacao', 'tipro_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Programação'],
            ],

            [
                'attribute'=>'placu_codsituacao', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->situacaoPlani->sipla_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Situacaoplanilha::find()->orderBy('sipla_descricao')->asArray()->all(), 'sipla_codsituacao', 'sipla_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Situação'],
            ],
        
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{observacoes-admin-gerentes} {view} {update} {delete}',
                'options' => ['width' => '5%'],
                'buttons' => [

                //PLANILHA COM ALGUMA JUSTIFICATIVA
                'observacoes-admin-gerentes' => function ($url, $model) {
                    return $model->placu_codsituacao == 2 ?  Html::a('<span class="glyphicon glyphicon-info-sign" style="color:red"></span>', $url, [
                        'title' => Yii::t('app', 'Observações'),
                           ]): '';
                        },

                //Situação 1 = Em Elaboração / 2 = Para Correção / 7 = Aguardando Envio Planejamento
                'update' => function ($url, $model) {
                    if($model->placu_codsituacao == 1 || $model->placu_codsituacao == 2 || $model->placu_codsituacao == 5){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Editar Planilha'),
                    ]);
                    }else{
                        '';
                    }
                },

                //Situação 1 = Em Elaboração / 2 = Para Correção / 7 = Aguardando Envio Planejamento
                'delete' => function ($url, $model) {
                    if($model->placu_codsituacao == 1 || $model->placu_codsituacao == 2 || $model->placu_codsituacao == 5){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                               'title' => Yii::t('app', 'Deletar Planilha'),
                               'data' => [
                                                'confirm' => 'Você tem CERTEZA que deseja EXCLUIR essa Planilha?',
                                                'method' => 'post',
                                        ],
                    ]);
                    }else{
                        '';
                    }
                },

                ],
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
