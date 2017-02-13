<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;
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
           </strong>Matr&iacute;culas por Segmentos</font></td>
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
				$codigo_segmento = 0;
				$conta_segmento[$codigo_segmento] = 0;
				//EXTRAINDO OS SEGMENTOS CADASTRADOS....
				$query_segmentos = "SELECT seg_codsegmento, seg_descricao FROM segmento_seg WHERE seg_codsegmento <> 17 ORDER BY seg_descricao";
			    $segmentos = Segmento::findBySql($query_segmentos)->all(); 

	            foreach ($segmentos as $segmento) {

			        $codigo_segmento  = $segmento['seg_codsegmento'];
			        $nome_segmento    = $segmento['seg_descricao'];

					 $conta_segmento[$codigo_segmento] = 0;

					?>
					      <th><?php echo $nome_segmento; ?></th>
					 
					 <?php
					  
			    }
			?>
		   
           <th>TOTAL</th>
           </tr>
		   
		   <?php
				//EXTRAINDO AS UNIDADES....
				$query_unidades = "SELECT placu_nomeunidade,placu_codunidade FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."'  group by placu_codunidade ORDER BY placu_nomeunidade";
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
					  $query_segmentos2 = "SELECT seg_codsegmento, seg_descricao FROM segmento_seg WHERE seg_codsegmento <> 17 ORDER BY seg_descricao";
					  $segmentos2 = Segmento::findBySql($query_segmentos2)->all(); 

	            	  foreach ($segmentos2 as $segmento) {
                      		$codigo_segmento  = $segmento['seg_codsegmento'];
					         
							 $quantidade_matriculas_por_segmento = 0;

							 //EXTRAINDO AS QUANTIDADES CONFORME O SEGMENTO E UNIDADE....
				            $query_planilhas = "SELECT placu_quantidadeturmas, placu_quantidadealunos,placu_quantidadealunospsg, placu_quantidadealunosisentos FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' AND placu_codunidade = '".$codigo_unidade."' AND placu_codsegmento = '".$codigo_segmento."'";

				            $planilhas = Planilhadecurso::findBySql($query_planilhas)->all(); 

	            	 		foreach ($planilhas as $planilha) {
                      			$quantidade_turmas  	   = $planilha['placu_quantidadeturmas'];
                      			$quantidade_alunos  	   = $planilha['placu_quantidadealunos'];
                      			$quantidade_alunos_psg     = $planilha['placu_quantidadealunospsg'];
                      			$quantidade_alunos_isentos = $planilha['placu_quantidadealunosisentos'];

								   $somar_matriculas = $quantidade_alunos + $quantidade_alunos_psg + $quantidade_alunos_isentos;
								   
								   $quantidade_matriculas_por_segmento = $quantidade_matriculas_por_segmento + ($quantidade_turmas * $somar_matriculas);
								   $soma_total_geral = $soma_total_geral + ($quantidade_turmas * $somar_matriculas);
					        }// FIM DAS QUANTIDADES..
					        
							$conta_segmento[$codigo_segmento] = $conta_segmento[$codigo_segmento] + $quantidade_matriculas_por_segmento;
							$subtotal_unidade = $subtotal_unidade + $quantidade_matriculas_por_segmento;
							
												  
					        ?>
							 <td><?php echo $quantidade_matriculas_por_segmento; ?></td>
							<?php
							
					  }// FIM DOS EIXOS...
					  
					  ?>
					  <td><?php echo $subtotal_unidade; ?></td>
                      </tr>     
					  <?php
					  		 
		        } // FIM DAS UNIDADES...
		    ?>
		  
		   
		   
           <tr style="background-color: #fcf8e3;"> 
           <td>TOTAL GERAL</td>
            <?php
				$query_segmentos3 = "SELECT seg_codsegmento, seg_descricao FROM segmento_seg WHERE seg_codsegmento <> 17 ORDER BY seg_descricao";
				  $segmentos2 = Segmento::findBySql($query_segmentos3)->all(); 

			    foreach ($segmentos2 as $segmento2) {

			    	$codigo_segmento = $segmento2['seg_codsegmento'];

		    ?>
					  <td><?php echo $conta_segmento[$codigo_segmento]; ?></td>
					  
			         <?php
			  }
		  
		  ?>
		  
          <td><?php echo $soma_total_geral; ?></td>
           </tr>

              </tbody>
            </table>
          </div>
		   
		   <br>
           <table width="100%" border="0">
           <tr>
           <td><div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
           em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></font></div></td>
           </tr>
           </table>