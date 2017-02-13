<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\cadastros\Eixo;
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
           </strong>Matr&iacute;culas por Eixos Tecnol&oacute;gicos</font></td>
           <td width="27%" align="right" valign="bottom"><em></em></td>
           </tr>
           <tr> 
           <td colspan="4"><hr align="left" width="70%"></td>
           </tr>
           <tr> 
           <td colspan="4"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CRIT&Eacute;RIOS 
           DO RELAT&Oacute;RIO</font></td>
           </tr>
           <tr> 
           <td colspan="4"><table width="100%" border="0">
           <tr> 
           <td width="4%">&nbsp;</td>
           <td width="9%" valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">UNIDADE</font></strong></td>
           <td colspan="3" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Todas</font></td>
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
           <td colspan="4"><hr align="right" width="70%"></td>
           </tr>
           </table>
		   <BR>
           
           
          <div class="container">
            <table class="table table-hover">
              <thead>
                <tr>
           <th>UNIDADES</th>
           
		    <?php
		        			
				$soma_total_geral = 0;
				$codigo_eixo = 0;
				$conta_eixo[$codigo_eixo] = 0;

				//EXTRAINDO OS EIXOS CADASTRADOS....
			    $query_eixos = "SELECT eix_codeixo, eix_descricao FROM eixo_eix WHERE eix_codeixo <> 8 ORDER BY eix_descricao";
			    $eixos = Eixo::findBySql($query_eixos)->all(); 

	           foreach ($eixos as $eixo) {

	           	$codigo_eixo = $eixo['eix_codeixo'];
	           	$nome_eixo   = $eixo['eix_descricao'];

	           	$conta_eixo[$codigo_eixo] = 0;

			?>		  
	
			<td><strong><?php echo $nome_eixo; ?></strong></td>
	
			<?php
				    }
			?>
		   
           <td><strong>TOTAL</strong></td>
           </tr>
		   
		   <?php
				//EXTRAINDO AS UNIDADES....
			    $query_unidades = "SELECT placu_nomeunidade,placu_codunidade FROM planilhadecurso_placu  WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' group by placu_codunidade order by placu_nomeunidade";

			    $unidades = Planilhadecurso::findBySql($query_unidades)->all(); 

	            foreach ($unidades as $unidade) {

			        $codigo_unidade  = $unidade['placu_codunidade'];
				    $nome_unidade    = $unidade['placu_nomeunidade'];

						 $subtotal_unidade = 0;
			?>
					 
					  <tr> 
                      <td><?php echo $nome_unidade; ?></td>
                     <?php
					  //RESGATANDO OS EIXOS CONFORME ORDEM DO CABEÇALHO...
					  $query_eixos2 = "SELECT eix_codeixo, eix_descricao FROM eixo_eix WHERE eix_codeixo <> 8 ORDER BY eix_descricao";
					    $eixos2 = Eixo::findBySql($query_eixos2)->all(); 

			           foreach ($eixos2 as $eixo2) {

			           	$codigo_eixo = $eixo2['eix_codeixo'];

							$quantidade_matriculas_por_eixo = 0;

							 //EXTRAINDO AS QUANTIDADES CONFORME O EIXO E UNIDADE....
					    $query_unidadesEixos = "SELECT placu_quantidadeturmas, placu_quantidadealunos, placu_quantidadealunospsg, placu_quantidadealunosisentos FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' and placu_codano = '".$ano_planilha['an_codano']."' and placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' and placu_codunidade = '".$codigo_unidade."' and placu_codeixo = '".$codigo_eixo."'";

					    $unidadesEixos = Planilhadecurso::findBySql($query_unidadesEixos)->all(); 

			            foreach ($unidadesEixos as $unidadesEixo) {

					        $quantidade_turmas 		   = $unidadesEixo['placu_quantidadeturmas'];
						    $quantidade_alunos         = $unidadesEixo['placu_quantidadealunos'];
						    $quantidade_alunos_psg     = $unidadesEixo['placu_quantidadealunospsg'];
						    $quantidade_alunos_isentos = $unidadesEixo['placu_quantidadealunosisentos'];
					            
								$soma_matricula 				= $quantidade_alunos + $quantidade_alunos_psg + $quantidade_alunos_isentos;
								$quantidade_matriculas_por_eixo += $quantidade_turmas * $soma_matricula;
								$soma_total_geral 				+= $quantidade_turmas * $soma_matricula;
					        }// FIM DAS QUANTIDADES..
							$conta_eixo[$codigo_eixo]			+= $quantidade_matriculas_por_eixo;
							$subtotal_unidade 					+= $quantidade_matriculas_por_eixo;
												  
					?>
							 <td><?php echo $quantidade_matriculas_por_eixo; ?></td>
							<?php
							
					  }// FIM DOS EIXOS...
					  
					  ?>
					  <td><?php echo $subtotal_unidade; ?></td>
                      </tr>     
					  <?php
					  		 
		        } // FIM DAS UNIDADES...
		    ?>
		   
           <tr style="background-color: #fcf8e3;">
           <td><strong>TOTAL GERAL</strong></td>
            <?php
				$query_eixos3 = "SELECT eix_codeixo, eix_descricao FROM eixo_eix WHERE eix_codeixo <> 8 ORDER BY eix_descricao";
				  $eixos3 = Eixo::findBySql($query_eixos3)->all(); 

			    foreach ($eixos3 as $eixo3) {

			    	$codigo_eixo = $eixo3['eix_codeixo'];

		    ?>
					<td><strong><?php echo $conta_eixo[$codigo_eixo]; ?></strong></td>
					  
		 <?php
			   }
		  
		  ?>
		  
          <td><strong><?php echo $soma_total_geral; ?></strong></td>
           </tr>

              </tbody>
            </table>
          </div>
				 
		   <br>
           <table width="100%" border="0">
           <tr>
           <td><div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
           em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></td>
           </tr>
           </table>
