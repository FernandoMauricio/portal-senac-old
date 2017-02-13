<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Tipo;
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
    <td align="left" valign="middle"><font size="3" face="Verdana, Arial, Helvetica, sans-serif">Aux&iacute;lio 
      ao Planejamento<strong><br>
      </strong>Carga Horária por Ações de Educação Profissional</font><em></em></td>
  </tr>
  <tr> 
    <td colspan="3"><hr align="left" width="70%"></td>
  </tr>
  <tr> 
    <td colspan="3"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CRIT&Eacute;RIOS 
      DO RELAT&Oacute;RIO</font></td>
  </tr>
  <tr> 
    <td colspan="3"><table width="100%" border="0">
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
    <td colspan="3"><hr align="right" width="70%"></td>
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
				$codigo_tipodeacao = 0;
				$conta_tipodeacao[$codigo_tipodeacao] = 0;
				//EXTRAINDO OS TIPOS CADASTRADOS....
				$query_tipos = "SELECT tip_codtipoa, tip_descricao FROM tipodeacao_tip,planilhadecurso_placu WHERE placu_codeixo <> 8 AND placu_codtipoa = tip_codtipoa GROUP BY placu_codtipoa ORDER BY tip_descricao";
		   	    $tipos = Tipo::findBySql($query_tipos)->all(); 

            	foreach ($tipos as $tipo) {
            		$codigo_tipodeacao  = $tipo['tip_codtipoa'];
			        $nome_tipodeacao    = $tipo['tip_descricao'];
					 
					 $conta_tipodeacao[$codigo_tipodeacao] = 0;

					?>
					      <td><strong><?php echo $nome_tipodeacao; ?></strong></td>
					 
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
					  $query_tipos2 = "SELECT tip_codtipoa, tip_descricao FROM tipodeacao_tip,planilhadecurso_placu WHERE placu_codeixo <> 8 AND placu_codtipoa = tip_codtipoa GROUP BY placu_codtipoa ORDER BY tip_descricao";
			        	$tipos2 = Tipo::findBySql($query_tipos2)->all(); 
			 
			            foreach ($tipos2 as $tipo2) {
			            	$codigo_tipodeacao  = $tipo2['tip_codtipoa'];
					         
							 $quantidade_cargahoraria_por_tipodeacao = 0;
							 //EXTRAINDO AS QUANTIDADES CONFORME O SEGMENTO E UNIDADE....
				            $query_planilhas = "SELECT placu_quantidadeturmas, placu_cargahorariaarealizar, placu_cargahorariavivencia FROM planilhadecurso_placu WHERE placu_codsituacao = '".$situacao_planilha['sipla_codsituacao']."' AND placu_codano = '".$ano_planilha['an_codano']."' AND placu_codtipla = '".$tipo_planilha['tipla_codtipla']."' AND placu_codunidade = '".$codigo_unidade."' AND placu_codtipoa = '".$codigo_tipodeacao."' AND placu_codeixo <> 8";
				        	$planilhas = Planilhadecurso::findBySql($query_planilhas)->all(); 
				 
				            foreach ($planilhas as $planilha) {
				            	$quantidade_turmas 		   		  = $planilha['placu_quantidadeturmas'];
				            	$quantidade_cargahoraria 		  = $planilha['placu_cargahorariaarealizar'];
				            	$quantidade_cargahoraria_vivencia = $planilha['placu_cargahorariavivencia'];
					               
								   $quantidade_cargahoraria += $quantidade_cargahoraria_vivencia;
								   
								   $quantidade_cargahoraria_por_tipodeacao += $quantidade_turmas * $quantidade_cargahoraria;
								   $soma_total_geral 					   += $quantidade_turmas * $quantidade_cargahoraria;
					        }// FIM DAS QUANTIDADES..
					        
							$conta_tipodeacao[$codigo_tipodeacao] += $quantidade_cargahoraria_por_tipodeacao;
							$subtotal_unidade 				      += $quantidade_cargahoraria_por_tipodeacao;
												  
					  ?>
							 <td><?php echo $quantidade_cargahoraria_por_tipodeacao; ?></td>
							<?php
							
					  }// FIM DOS EIXOS...
					  
					  ?>
					  <td><?php echo $subtotal_unidade; ?></td>
                      </tr>     
					  <?php
					  		 
		        } // FIM DAS UNIDADES...
		    ?>
		  
		   
		   
           <tr> 
           <td><strong>TOTAL GERAL </strong></td>
          <?php
		      $query_tipos3 = "SELECT tip_codtipoa, tip_descricao FROM tipodeacao_tip,planilhadecurso_placu WHERE placu_codeixo <> 8 AND placu_codtipoa = tip_codtipoa GROUP BY placu_codtipoa ORDER BY tip_descricao";
		   	    $tipos3 = Tipo::findBySql($query_tipos3)->all(); 

            	foreach ($tipos3 as $tipo3) {
            		$codigo_tipodeacao  = $tipo3['tip_codtipoa'];
		  ?>
					  <td><strong><?php echo $conta_tipodeacao[$codigo_tipodeacao] ;?> </strong></td>
					  
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
           em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></font></div></td>
           </tr>
           </table>