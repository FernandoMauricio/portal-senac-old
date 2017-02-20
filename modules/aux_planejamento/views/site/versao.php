<?php
/* @var $this yii\web\View */
// namespace yii\bootstrap;
use yii\helpers\Html;
use app\modules\aux_planejamento\models\Comunicacaointerna;
use app\modules\aux_planejamento\models\Destinocomunicacao;
use yii\helpers\ArrayHelper;

$this->title = 'Auxílio ao Planejamento';

?>

<div class="site-index">
        <h1 class="text-center"> Histórico de Versões</h1>
            <div class="body-content">
                <div class="container">

                <div class="panel panel-primary">
                <div class="panel-heading">
                            <i class="glyphicon glyphicon-star-empty"></i> Versão 1.1 - (ATUALMENTE) - Publicado em 17/02/2017
                </div>
                  <div class="panel-body">
              <h4><strong style="color: #337ab7;">Implementações</strong></h4>
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Cadastros de Material de Consumo - Importação MXM</strong></h5>
                            <h5>- Foi implementado a importação de produtos diretamente do MXM seguindo algumas regras, são elas:</h5>
                            <ul>
                              <li>Apenas produtos que contenham valor financeiro <strong style="color: red;">maior que 0</strong> serão importados.</li>
                              <li>Produtos já cadastrados anteriormente apenas sofrerão alterações caso o valor a ser importado seja maior que 0, se não, permanecerá o valor cadastrado pelo usuário.</li>
                              <li>Produtos que contenham divergências na descrição, serão atualizados automaticamente conforme a descrição do MXM.</li>
                              <li>Produtos que não tiverem o código do MXM não sofrerão nenhum tipo de atualização.</li>
                            </ul>
                        <h5>- Todos os produtos que sofrerem atualizações em seus valores, automaticamente serão atualizados onde estiverem inseridos nos Planos.</h5><br>
                        
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Planos de Ação</strong></h5>
                        <h5>- Alterado a nomenclatura da situação do Plano de: <strong style="color: red;">Ativo/Inativo</strong> para <strong style="color: green;">Liberado/Em elaboração</strong>. </h5>
                        <h5>- Informações de Níveis, Eixos, Segmentos e Tipos de Ação por enquanto, não poderão ser editadas. Caso necessite, informe à GIC para realizar a alteração. (*Obs.: Essa ação foi tomada pois a cada atualização do plano, o usuário tinha que incluir novamente as informações de Segmentos e Tipos de Ação. Nas próximas atualizações iremos corrigir para que o próprio usuário edite informações de Segmento e Tipo de Ação).</h5>
                  </div>
                </div>

                <div class="panel panel-danger">
                <div class="panel-heading">
                            <i class="glyphicon glyphicon-folder-close"></i> Versão 1.0 - Publicado em 15/12/2016
                </div>
                <div class="panel-body">
                  <h4><strong style="color: #337ab7;">Implementações</strong></h4>
                            <h5><i class="glyphicon glyphicon-tag"></i><strong> Cadastros</strong></h5>
                                <h5>- Cadastro de Materiais Didáticos </h5>
                                <h5>- Cadastro de Planos </h5>
                                <h5>- Cadastro de Planilhas de Curso (cadastro realizado pelo gerente imediato da unidade) </h5>
                                <h5>- Cadastro de Planilhas de Precificação </h5><br>

                                <h5><i class="glyphicon glyphicon-tag"></i><strong> Modelo A</strong></h5>
                                <h5>- Geração do Modelo A</h5>
                                <h5>- Atualização e Impressão do Modelo A</h5><br>

                                <h5><i class="glyphicon glyphicon-tag"></i><strong> Solicitações de Cópias</strong></h5>
                                <h5>- Solicitação e Acompanhamento de Cópias de Material (Apostilas)</h5><br>

                                <h5><i class="glyphicon glyphicon-tag"></i><strong> Relatórios</strong></h5>
                                <h5>- Visualizar Relatórios (Relatórios PAAR, MODELO B e Relatório Geral)</h5>
                </div>
                </div>

            </div>
        </div>   
</div>