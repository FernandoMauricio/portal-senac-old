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

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Ficha do Candidato: <span class="text-uppercase"> <?= $model->nome ?></span></h3>
  </div>

      <div class="panel-body">
          <div class="row">

                              <!--    INFORMÇÕES DO CANDIDATO    -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">Informações</th></tr>
    </thead>
    <tr>
        <td colspan="1"><strong>Código: </strong><?php echo $model->id; ?></td>
        <td colspan="1"><strong>Edital: </strong><?php echo $model->edital; ?></td> 
        <td colspan="2"><strong>Inscrição: </strong> <?php echo $model->numeroInscricao; ?></td>
        <td colspan="3"><strong>Situação: </strong> <?php echo $model->classificado ? '<span class="label label-success">Classificado</span>' : '<span class="label label-danger">Desclassificado</span>' ?></td>
    </tr> 
<tbody>
    <tr>
        <td colspan="12"><strong>Nome: </strong> <?php echo $model->nome; ?></td>
     </tr> 

    <tr>
        <td colspan="12"><strong>Link Lattes: </strong> <?php echo $model->curriculo_lattes; ?></td>
     </tr> 

    <tr>
        <td colspan="2"><strong>Pessoa com Deficiência? </strong> <?php echo $model->deficiencia ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="6"><strong>Se sim, especificar CID: </strong> <?php echo $model->deficiencia_cid; ?></td>
     </tr> 

     <tr>
        <td colspan="2"><strong>Cargo: </strong> <?php echo $model->cargo; ?></td>
        <td colspan="2"><strong>CPF: </strong> <?php echo $model->cpf; ?></td>
        <td colspan="1"><strong>Idade: </strong> <?php echo $model->idade; ?></td>
        <td colspan="2"><strong>Sexo: </strong> <?php echo $model->sexo ? 'Masculino' : 'Feminino' ?></td>
     </tr> 

     <tr>
        <td colspan="2"><strong>Email: </strong> <?php echo $model->email; ?></td>
        <td colspan="6"><strong>Email Alternativo: </strong> <?php echo $model->emailAlt; ?></td>
     </tr> 

     <tr>
        <td colspan="2"><strong>Telefone: </strong> <?php echo $model->telefone; ?></td>
        <td colspan="6"><strong>Telefone Alternativo: </strong> <?php echo $model->telefoneAlt; ?></td>
     </tr> 

    <tr>
        <td colspan="12"><strong>Data/Hora da Inscrição: </strong> <?php echo date('d/m/Y H:i:s', strtotime($model->data)); ?></td>
     </tr> 

    </tbody>
 </table>


                        <!--    ENDEREÇO  -->


  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">Endereço</th></tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="5"><strong>Endereço:</strong> <?php echo $curriculosEndereco->endereco ?></td>
            <td colspan="2"><strong>Número:</strong> <?php echo $curriculosEndereco->numero_end ?></td>
            <td colspan="2"><strong>Bairro:</strong> <?php echo $curriculosEndereco->bairro ?></td>
        </tr>

        <tr>
            
            <td colspan="2"><strong>Complemento:</strong> <?php echo $curriculosEndereco->complemento ?></td>
            <td colspan="2"><strong>Cidade:</strong> <?php echo $curriculosEndereco->cidade ?></td>
            <td colspan="2"><strong>Estado:</strong> <?php echo $curriculosEndereco->estado ?></td>
            <td colspan="2"><strong>CEP:</strong> <?php echo $curriculosEndereco->cep ?></td>
        </tr>
    </tbody>
  </table>

                        <!--    FORMAÇÃO ESCOLAR  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">Formação Escolar</th></tr>
    </thead>
    <tbody>
        <tr>

          <td colspan="12"><strong>Ensino Fundamental: </strong><?php echo $curriculosFormacao->fundamental_comp ? 'Completo' : 'Incompleto' ?></td>

        <tr>
          <td colspan="12"><strong>Ensino Médio: </strong><?php echo $curriculosFormacao->medio_comp ? 'Completo' : 'Incompleto' ?></td>
        </tr>

        <tr>
          <td colspan="3"><strong>Ensino Técnico: </strong><?php echo $curriculosFormacao->tecnico ? 'Completo' : 'Incompleto' ?></td>
          <td colspan="9"><strong>Curso Técnico: </strong><?php echo $curriculosFormacao->tecnico_area ?></td>
        </tr>

        <tr>
          <td colspan="3"><strong>Ensino Superior: </strong><?php echo $curriculosFormacao->superior_comp ? 'Completo' : 'Incompleto' ?></td>
          <td colspan="9"><strong>Curso Graduação: </strong><?php echo $curriculosFormacao->superior_area ?></td>
        </tr>

        <tr>
          <td colspan="3"><strong>Pós Graduação: </strong><?php echo $curriculosFormacao->pos ? 'Completo' : 'Incompleto' ?></td>
          <td colspan="9"><strong>Curso Pós-Graduação: </strong><?php echo $curriculosFormacao->pos_area ?></td>
        </tr>

        <tr>
          <td colspan="3"><strong>Mestrado: </strong><?php echo $curriculosFormacao->mestrado ? 'Completo' : 'Incompleto' ?></td>
          <td colspan="9"><strong>Curso Mestrado: </strong><?php echo $curriculosFormacao->mestrado_area ?></td>
        </tr>

        <tr>
          <td colspan="3"><strong>Doutorado: </strong><?php echo $curriculosFormacao->doutorado ? 'Completo' : 'Incompleto' ?></td>
          <td colspan="9"><strong>Curso Doutorado: </strong><?php echo $curriculosFormacao->doutorado_area ?></td>
        </tr>

        <tr>
          <td colspan="1"><strong>Estuda Atualmente: </strong><?php echo $curriculosFormacao->estuda_atualmente ? 'Sim' : 'Não' ?></td>
          <td colspan="2"><strong>Curso: </strong><?php echo $curriculosFormacao->estuda_curso ?></td>
          <td colspan="8"><strong>Turno: </strong>
            <?php echo $curriculosFormacao->estuda_turno_mat ? '[X] Matutino' : '[ ] Matutino' ?>
            <?php echo $curriculosFormacao->estuda_turno_vesp ? '[X] Vespertino' : '[ ] Vespertino' ?>
            <?php echo $curriculosFormacao->estuda_turno_not ? '[X] Noturno' : '[ ] Noturno' ?> </td>
        </tr>
      </tr>
    </tbody>
  </table>

                        <!--    CURSOS COMPLEMENTARES  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">Cursos Complementares</th></tr>
    </thead>

          <?php 
          foreach ($curriculosComplemento as $value) {

              $curso = $value["cursos"];
              $certificado = $value["certificado"];
          ?>
    <tbody>
        <tr>
          <td colspan="1"><strong>Curso Complementar: </strong><?php echo $curso ?></td>
          <td colspan="6"><strong>Tem certificado: </strong><?php echo $certificado ? 'Sim' : 'Não' ?></td>
      </tr>
    </tbody>
          <?php 
          }
          ?>

  </table>

                        <!--    EMPREGOS ANTERIORES  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">Empregos Anterioes</th></tr>
    </thead>


        <?php 

        foreach ($curriculosEmpregos as $value) {

            $empresa    = $value["empresa"];
            $cidade     = $value["cidade"];
            $cargo      = $value["cargo"];
            $atividades = $value["atividades"];
            $inicio     = $value["inicio"];
            $termino    = $value["termino"];
        ?>
       <tbody>
        <tr>                                            
                  <td colspan="6"><strong>Empresa: </strong><?php echo $empresa ?></td>
                  <td colspan="3"><strong>Cidade: </strong><?php echo $cidade ?></td>
                </tr>
                <tr>
                  <td colspan="5"><strong>Cargo: </strong><?php echo $cargo ?></td>
                  <td colspan="2"><strong>Início: </strong><?php echo $inicio ?></td>
                  <td colspan="2"><strong>Término: </strong><?php echo $termino ?></td>
                </tr>
                <tr>
                  <td colspan="12"><strong>Atividades Desenvolvidas: </strong><?php echo $atividades ?></td>
                </tr>
                <hr>
        </tr>
      </tbody>
        <?php 
        }
        ?>



  </table>

   </div>
 </div>
</div>