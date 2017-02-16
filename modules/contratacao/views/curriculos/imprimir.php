<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\contratacao\models\Curriculos;
use app\modules\contratacao\models\CurriculosEndereco;
use app\modules\contratacao\models\CurriculosFormacao;
use app\modules\contratacao\models\CurriculosComplemento;
use app\modules\contratacao\models\CurriculosEmpregos;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$session = Yii::$app->session;

$id = $_GET['id'];

 $sql = 'SELECT * FROM curriculos WHERE id ='.$id.' ';
        $model = Curriculos::findBySql($sql)->one(); 

        //busca endereço
        $sql_endereco = 'SELECT * FROM curriculos_endereco WHERE curriculos_id ='.$id.' ';
        $curriculosEndereco = CurriculosEndereco::findBySql($sql_endereco)->one();  

        //busca formação
        $sql_formacao = 'SELECT * FROM curriculos_formacao WHERE curriculos_id ='.$id.' ';
        $curriculosFormacao = CurriculosFormacao::findBySql($sql_formacao)->one();  

        //busca cursos complementares
        $sql_complemento = 'SELECT * FROM curriculos_complemento WHERE curriculos_id ='.$id.' ';
        $curriculosComplemento = CurriculosComplemento::findBySql($sql_complemento)->all();  

        //busca empregos anteriores
        $sql_emprego = 'SELECT * FROM curriculos_empregos WHERE curriculos_id ='.$id.' ';
        $curriculosEmpregos = CurriculosEmpregos::findBySql($sql_emprego)->all();  



$this->title = $model->numeroInscricao;

$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] =  $this->title;
?>
<div class="curriculos-view">

    <h1>Número de Inscrição: <?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Informações do Candidato: <span class="text-uppercase"> <?= $model->nome ?></span></h3>
  </div>
  <div class="panel-body">
  <div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'edital',
            'numeroInscricao',
            'cargo',
            'nome',
            'cpf',
            [
                'attribute' => 'datanascimento',
                'format' => ['date', 'php:d/m/Y'],
            ],
            'idade',
            [
                'attribute'=>'sexo', 
                'label'=>'Sexo',
                'format'=>'raw',
                'value'=>$model->sexo ? 'Masculino' : 'Feminino',
            ],
            'email:email',
            'emailAlt:email',
            'telefone',
            'telefoneAlt',
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y H:i:s'],
            ],
            [
                'attribute'=>'classificado', 
                'label'=>'Situação do Candidato',
                'format'=>'raw',
                'value'=>$model->classificado ? '<span class="label label-success">Classificado</span>' : '<span class="label label-danger">Desclassificado</span>',
                'valueColOptions'=>['style'=>'width:100%']
            ],
        ],
    ]) ?>
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

          <div class="col-md-3"><strong>Ensino Superior: </strong><?php echo $curriculosFormacao->superior_comp ? 'Completo' : 'Incompleto' ?></div>

          <div class="col-md-9"><strong>Curso Graduação: </strong><?php echo $curriculosFormacao->superior_area ?></div>

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
<hr>
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

