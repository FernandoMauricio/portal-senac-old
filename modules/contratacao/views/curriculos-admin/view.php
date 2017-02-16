<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$this->title = $model->numeroInscricao;

$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] =  $this->title;
?>
<div class="curriculos-view">


    <?php
/**
 * THE VIEW BUTTON
 */
echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['imprimir','id' => $model->id], [
    'class'=>'btn pull-right btn-info btn-lg', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>' Clique aqui para gerar um arquivo PDF'
]);

    ?>

    <h1>Número de Inscrição: <?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="text-uppercase"> <?= $model->nome ?></span></h3>
  </div>
  <div class="panel-body">
  <div class="row">


<?php
        $attributes = [
            [
            'attribute' => 'id',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'edital',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'numeroInscricao',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'cargo',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'nome',
            'displayOnly'=>true,
            ],
            [
                'attribute'=>'curriculo_lattes', 
                'label'=>'Link Lattes',
                'format'=>'raw',
                'value'=>Html::a($model->curriculo_lattes, $model->curriculo_lattes, ['class'=>'kv-author-link']),
                'displayOnly'=>true,
            ],
            [
            'attribute' => 'deficiencia',
            'label'=>'Pessoa com Deficiência?',
            'format'=>'raw',
            'value'=>$model->deficiencia_cid ? 'Sim' : 'Não',
            'displayOnly'=>true,
            ],
            [
            'attribute'=>'deficiencia_cid', 
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'cpf',
            'displayOnly'=>true,
            ],
            [
                'attribute' => 'datanascimento',
                'format' => ['date', 'php:d/m/Y'],
                'displayOnly'=>true,
            ],
            [
            'attribute' => 'idade',
            'displayOnly'=>true,
            ],
            [
                'attribute'=>'sexo', 
                'label'=>'Sexo',
                'format'=>'raw',
                'value'=>$model->sexo ? 'Masculino' : 'Feminino',
                'displayOnly'=>true,
            ],
            [
            'attribute' => 'email',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'emailAlt',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'telefone',
            'displayOnly'=>true,
            ],
            [
            'attribute' => 'telefoneAlt',
            'displayOnly'=>true,
            ],

            [
                'attribute' => 'data',
                'format'=>['datetime', 'php:d/m/Y H:i:s'],
                'displayOnly'=>true,
            ],
            // [
            //     'attribute'=>'classificado', 
            //     'label'=>'Situação do Candidato',
            //     'format'=>'raw',
            //     'value'=>$model->classificado ? '<span class="label label-success">Classificado</span>' : '<span class="label label-danger">Desclassificado</span>',
            //     'valueColOptions'=>['style'=>'width:100%']
            // ],

  [
        'attribute'=>'classificado', 
        'label'=>'Situação do Candidato',
        'format'=>'raw',
        'value'=>$model->classificado ? 
            '<span class="label label-success">Classificado</span>' : 
            '<span class="label label-danger">Desclassificado</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions'=>[
            'pluginOptions'=>[
                'onText'=>'Classificado',
                'offText'=>'Desclassificado',
            ]
        ]
    ],

        ]
?>

<?php

echo DetailView::widget([
    'model'=>$model,
    'attributes'=>$attributes,
    'condensed'=>true,
    'buttons1' => '{update}', 
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
          'heading'=>'Informações do Candidato: ',
          'type'=>DetailView::TYPE_INFO,
      ],
]);


?>
</div>

                    <!--    INFORMÇÕES DO CANDIDATO    -->

  </div>
</div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Endereço</h3>
  </div>
    <div class="panel-body">
          <div class="row">

          <div class="col-md-6"><strong>Endereço:</strong> <?php echo $curriculosEndereco->endereco ?></div>
          <div class="col-md-2"><strong>Número:</strong> <?php echo $curriculosEndereco->numero_end ?></div>
          <div class="col-md-4"><strong>Bairro:</strong> <?php echo $curriculosEndereco->bairro ?></div>
          <div class="col-md-6"><strong>Complemento:</strong> <?php echo $curriculosEndereco->complemento ?></div>
          <div class="col-md-4"><strong>Cidade:</strong> <?php echo $curriculosEndereco->cidade ?></div>
          <div class="col-md-2"><strong>Estado:</strong> <?php echo $curriculosEndereco->estado ?></div>
          <div class="col-md-2"><strong>CEP:</strong> <?php echo $curriculosEndereco->cep ?></div>

         </div>

    </div>
</div>


                        <!--    ENDEREÇO  -->

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Formação Escolar</h3>
  </div>
  <div class="panel-body">
  <div class="row">

          <div class="col-md-12"><strong>Ensino Fundamental: </strong><?php echo $curriculosFormacao->fundamental_comp ? 'Completo' : 'Incompleto' ?></div>

          <div class="col-md-12"><strong>Ensino Médio: </strong><?php echo $curriculosFormacao->medio_comp ? 'Completo' : 'Incompleto' ?></div>

          <div class="col-md-3"><strong>Ensino Técnico: </strong><?php echo $curriculosFormacao->tecnico ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Técnico: </strong><?php echo $curriculosFormacao->tecnico_area ?></div>

          <div class="col-md-3"><strong>Ensino Superior: </strong><?php echo $curriculosFormacao->superior_comp ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Superior: </strong><?php echo $curriculosFormacao->superior_area ?></div>


          <div class="col-md-3"><strong>Pós Graduação: </strong><?php echo $curriculosFormacao->pos ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Pós-Graduação: </strong><?php echo $curriculosFormacao->pos_area ?></div>

          <div class="col-md-3"><strong>Mestrado: </strong><?php echo $curriculosFormacao->mestrado ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Mestrado: </strong><?php echo $curriculosFormacao->mestrado_area ?></div>

          <div class="col-md-3"><strong>Doutorado: </strong><?php echo $curriculosFormacao->doutorado ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Doutorado: </strong><?php echo $curriculosFormacao->doutorado_area ?></div>

          <div class="col-md-3"><strong>Estuda Atualmente: </strong><?php echo $curriculosFormacao->estuda_atualmente ? 'Sim' : 'Não' ?></div>
          <div class="col-md-4"><strong>Curso: </strong><?php echo $curriculosFormacao->estuda_curso ?></div>
          <div class="col-md-5"><strong>Turno: </strong>
            <?php echo $curriculosFormacao->estuda_turno_mat ? '[X] Matutino' : '[ ] Matutino' ?>
            <?php echo $curriculosFormacao->estuda_turno_vesp ? '[X] Vespertino' : '[ ] Vespertino' ?>
            <?php echo $curriculosFormacao->estuda_turno_not ? '[X] Noturno' : '[ ] Noturno' ?>
          </div>
  </div>
</div>
</div>

                        <!--    CURSOS COMPLEMENTARES  -->

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Cursos Complementares</h3>
  </div>
  <div class="panel-body">
  <div class="row">

<?php 

foreach ($curriculosComplemento as $value) {

    $curso = $value["cursos"];
    $certificado = $value["certificado"];
?>
<div class="col-md-5"><strong>Curso Complementar: </strong><?php echo $curso ?></div>
<div class="col-md-5"><strong>Tem certificado: </strong><?php echo $certificado ? 'Sim' : 'Não' ?></div>

<?php 
}
?>
  </div>
</div>
</div>



<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Empregos Anterioes</h3>
  </div>


  <div class="row">

<?php 

foreach ($curriculosEmpregos as $value) {

    $empresa    = $value["empresa"];
    $cidade     = $value["cidade"];
    $cargo      = $value["cargo"];
    $atividades = $value["atividades"];
    $inicio     = $value["inicio"];
    $termino    = $value["termino"];
?>

    <div class="panel-body">
                                                        
            <div class="col-md-12"><strong>Empresa: </strong><?php echo $empresa ?></div>
            <div class="col-md-12"><strong>Cidade: </strong><?php echo $cidade ?></div>

            <div class="col-md-12"><strong>Cargo: </strong><?php echo $cargo ?></div>
            <div class="col-md-12"><strong>Início: </strong><?php echo $inicio ?></div>
            <div class="col-md-12"><strong>Término: </strong><?php echo $termino ?></div>

            <div class="col-md-12"><strong>Atividades Desenvolvidas: </strong><?php echo $atividades ?></div>
    <hr>
    </div>

    
<?php 
}
?>
  </div>
</div>
</div>

