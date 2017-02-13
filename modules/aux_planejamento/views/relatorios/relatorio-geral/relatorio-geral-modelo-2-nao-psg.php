<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Nivel;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;
use app\modules\aux_planejamento\models\cadastros\Tipo;
use app\modules\aux_planejamento\models\planos\Planodeacao;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
?>

<table width="100%" border="0">
  <tr> 
    <td width="21%"><img src="<?php echo Url::base().'/uploads/logo.png' ?>" height="100px"></td>
    <td width="11%" align="left" valign="middle"> <p><br>
        <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>M&oacute;dulo: 
        </strong><strong><br>
        Relat&oacute;rio: </strong></font><br>
        <br>
      </p></td>
    <td width="41%" align="left" valign="middle"><font size="3" face="Verdana, Arial, Helvetica, sans-serif">Aux&iacute;lio 
      ao Planejamento<strong><br>
      </strong>Relat&oacute;rio Geral - Modelo II / PSG</font></td>
    <td colspan="2" align="right" valign="bottom"><em></em></td>
  </tr>
  <tr> 
    <td colspan="5"><hr align="left" width="70%"></td>
  </tr>
  <tr> 
    <td colspan="5"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CRIT&Eacute;RIOS 
      DO RELAT&Oacute;RIO</font></td>
  </tr>
  <tr> 
    <td colspan="5"><table width="100%" border="0">
        <tr> 
          <td width="4%">&nbsp;</td>
          <td width="9%" valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">UNIDADE</font></strong></td>
          <td colspan="3" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $combounidade['placu_codunidade'] == 0 ? "Todas as Unidades" : $combounidade['placu_nomeunidade'];?></font></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">ANO</font></strong></td>
          <td width="12%" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $ano_planilha['an_ano'];?></font></td>
          <td width="13%" valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>SITUA&Ccedil;&Atilde;O</strong></font></td>
          <td width="62%" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $situacao_planilha['sipla_descricao'];?></font></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">TIPO</font></strong></td>
          <td colspan="3" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $tipo_planilha['tipla_descricao'];?></font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="5"><hr align="right" width="70%"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="11%"><div align="center"></div></td>
    <td width="16%">
            <!-- Visualizar as informações de PSG-->

        <?= Html::a('<i class="glyphicon glyphicon-print"></i> PSG', ['relatorio-geral-modelo-2-psg', 'combounidade' => $combounidade['placu_codunidade'] == 0 ? 0 : $combounidade['placu_codunidade'], 'ano_planilha' => $ano_planilha['an_codano'], 'situacao_planilha' => $situacao_planilha['sipla_codsituacao'], 'tipo_planilha' => $tipo_planilha['tipla_codtipla'], 'modelorelatorio' => 2, 'combotipoprogramacao' => $combotipoprogramacao['tipro_codprogramacao']], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </td>
  </tr>
</table>
           <br>
		   		   
		   <?php
		  
       $valor_hora_aluno_total_geral = 0;
       $carga_horaria_total_geral = 0;
       $quantidade_turmas_total_geral = 0;
       $matricula_pag_total_geral = 0;
       $matricula_psg_total_geral = 0;
       $matricula_isento_total_geral = 0;    

		   if($combounidade['placu_codunidade'] == 0)//TODAS...
		     	   $query_unidades = "SELECT placu_nomeunidade,placu_codunidade FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' GROUP BY placu_codunidade ORDER BY placu_nomeunidade";
           else //UMA UNIDADE EM ESPECÍFICO...
		           $query_unidades = "SELECT placu_nomeunidade,placu_codunidade FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' AND placu_codunidade = '".$combounidade['placu_codunidade']."' GROUP BY placu_codunidade ORDER BY placu_nomeunidade";
		   
            $unidades = Planilhadecurso::findBySql($query_unidades)->all(); 

              foreach ($unidades as $unidade) {
                $codigo_unidade = $unidade['placu_codunidade'];
                $nome_unidade   = $unidade['placu_nomeunidade'];
				 
				 $carga_horaria_total = 0;
		     $quantidade_turmas_total = 0;
		     $matricula_pag_total = 0;
		     $matricula_psg_total = 0;
				 $matricula_isento_total = 0;
				 
				 $hora_aluno_unidade = 0;
				 
				 ?>
				
			         <table width="100%" border="0">
                     <tr> 
                     <td valign="middle" bgcolor="#E0E0E0"><font size="2" face="Arial, Helvetica, sans-serif"><em><?php echo $nome_unidade; ?></em></font></td>
                     </tr>
                     </table>
										 
					 
<table width="100%" border="1" cellspacing="0" bordercolor="#000000">
  <tr valign="middle"> 
    <td width="27%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PLANO</font></strong></div></td>
    <td width="8%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">TURMAS</font></strong></div></td>
    <td width="9%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CH</font></strong></div></td>
    <td width="6%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CH 
        SUBTOTAL</font></strong></div></td>
    <td width="6%"><div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CHA 
        - PSG</font></strong></div></td>
    <td width="8%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">QTD 
        ALUNO PAGANTE</font></strong></div></td>
    <td width="10%"><div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">QTD 
        ALUNO<br>
        PSG</font></strong></div></td>
    <td width="7%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">QTD 
        ALUNO<br>
        ISEN</font></strong></div></td>
    <td width="8%"><div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">SUBTOTAL 
        <br>
        PAGANTE</font></strong></div></td>
    <td width="5%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">SUBTOTAL 
        <br>
        PSG </font></strong></div></td>
    <td width="6%"><div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">SUBTOTAL 
        <br>
        ISEN</font></strong></div></td>
  </tr>
  <?php
					 //EXTRAINDO AS INFORMAÇÕES DAS PLANILHAS...
					 $query_planilhas = "SELECT plan_descricao, placu_cargahorariaarealizar,placu_quantidadealunosisentos, placu_cargahorariavivencia, placu_quantidadeturmas, placu_codeixo, placu_quantidadealunos, placu_quantidadealunospsg, placu_codplano FROM  planilhadecurso_placu, planodeacao_plan WHERE placu_codunidade = '".$codigo_unidade."' AND placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' AND placu_quantidadealunospsg = 0 AND placu_codplano = plan_codplano AND placu_codprogramacao = '".$combotipoprogramacao['tipro_codprogramacao']."'  ORDER BY plan_descricao";

            $planilhas = Planilhadecurso::findBySql($query_planilhas)->all(); 
                     foreach ($planilhas as $planilha) {

                      $nome_plano                  = $planilha['plano']['plan_descricao'];
                      $carga_horaria_realizar      = $planilha['placu_cargahorariaarealizar'];
                      $carga_horaria_vivencia      = $planilha['placu_cargahorariavivencia'];
                      $quantidade_turmas           = $planilha['placu_quantidadeturmas'];
                      $quantidade_alunos           = $planilha['placu_quantidadealunos'];
                      $quantidade_alunos_psg       = $planilha['placu_quantidadealunospsg'];
                      $quantidade_alunos_isentos   = $planilha['placu_quantidadealunosisentos'];
                      $codigo_eixo                 = $planilha['placu_codeixo'];

    							  $carga_horaria_planilha = $carga_horaria_realizar +  $carga_horaria_vivencia;
    							  
    							  $carga_horaria_total     += $carga_horaria_planilha * $quantidade_turmas;
    							  $matricula_pag_total     += $quantidade_alunos * $quantidade_turmas;
    							  $matricula_psg_total     += $quantidade_alunos_psg * $quantidade_turmas;
    							  $matricula_isento_total  += $quantidade_alunos_isentos * $quantidade_turmas;
    							  $quantidade_turmas_total += $quantidade_turmas;
    							  
    							  $carga_horaria_total_geral     += $carga_horaria_planilha * $quantidade_turmas;
    		            $quantidade_turmas_total_geral += $quantidade_turmas;
    		            $matricula_pag_total_geral     += $quantidade_alunos * $quantidade_turmas; 
    		            $matricula_psg_total_geral     += $quantidade_alunos_psg * $quantidade_turmas; 
    							  $matricula_isento_total_geral  += $quantidade_alunos_isentos * $quantidade_turmas; 
    							  
    							 $calculo1 = $carga_horaria_realizar * ($quantidade_alunos + $quantidade_alunos_psg + $quantidade_alunos_isentos);
    							 $calculo1 = $calculo1 * $quantidade_turmas;
    							 
    							 $calculo20 = $carga_horaria_realizar * $quantidade_alunos_psg;
    							 $calculo20 = $calculo20 * $quantidade_turmas;
    							 
    							 if($codigo_eixo != 8)
    							 {
    							       $hora_aluno_unidade = $hora_aluno_unidade + $calculo20;
    							 						 
    							       $valor_hora_aluno_total_geral = $valor_hora_aluno_total_geral + $calculo20;						  
    							 						   
    							 }  
	?>

  <tr valign="middle"> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $nome_plano; ?></font></td>
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_turmas; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $carga_horaria_planilha; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_turmas * $carga_horaria_planilha; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $calculo20; ?></font></font></font></font></div></td>
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos; ?></font></font></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos_psg; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos_isentos; ?></font></font></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos * $quantidade_turmas; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos_psg * $quantidade_turmas; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_alunos_isentos * $quantidade_turmas; ?></font></font></font></font></div></td>
  </tr>
    <?php
							  
			}
					 		 
		?>
  <tr valign="middle"> 
    <td bgcolor="#E0E0E0"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>TOTAL</strong></em></font></div></td>
    <td bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_turmas_total; ?></font></font></font></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><em></em></font></div></td>
    <td bgcolor="#E0E0E0"><div align="center">--------</div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $carga_horaria_total; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $hora_aluno_unidade; ?></font></font></font></font></div></td>
    <td colspan="3" bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div>
      <div align="center">-------------------</div>
      <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_pag_total; ?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_psg_total;?></font></font></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_isento_total;?></font></font></font></font></div></td>
  </tr>
</table>
<br>
    <?php
		   
		   } // FIM DAS UNIDADES...
		   
		?>
          
		  
<table width="61%" border="1" cellspacing="0" bordercolor="#000000">
  <tr> 
    <td colspan="6" valign="middle" bgcolor="#E0E0E0"> <div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif">RESUMO</font></div></td>
  </tr>
  <tr valign="middle"> 
    <td width="23%" bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">TURMAS</font></font></div></td>
    <td width="17%" bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">ALUNOS<br>
        PAG </font></font></div></td>
    <td width="17%" bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">ALUNOS 
        <br>
        PSG </font></font></div></td>
    <td width="16%" bgcolor="#E0E0E0"><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">ALUNOS 
        <br>
        ISEN</font></font></div></td>
    <td width="15%" bgcolor="#E0E0E0"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">CARGA 
        <br>
        HOR&Aacute;RIA</font></font></div></td>
    <td width="12%" bgcolor="#E0E0E0"><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">VALOR 
        HORA ALUNO PSG</font></font></div></td>
  </tr>
  <tr align="center" valign="middle"> 
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $quantidade_turmas_total_geral; ?></font></font></div></td>
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_pag_total_geral; ?></font></font></div></td>
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_psg_total_geral; ?></font></font></div></td>
    <td><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $matricula_isento_total_geral; ?></font></font></td>
    <td> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $carga_horaria_total_geral;?></font></font></div></td>
    <td><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><?php echo $valor_hora_aluno_total_geral;?></font></font></td>
  </tr>
</table> 
		   
<br>
          <table width="100%" border="0">
          <tr>
          <td><div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
          em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></font></div></td>
          </tr>
          </table>