<?php

namespace app\modules\aux_planejamento\controllers\relatorios;

use Yii;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\relatorios\RelatorioGeral;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;


class RelatorioGeralController extends Controller
{

    public function behaviors()
    {

      $this->AccessAllow(); //Irá ser verificado se o usuário está logado no sistema

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGerarRelatorio()
    {

	    $model = new RelatorioGeral();

	    $unidades     	  = Unidade::find()->where(['uni_codsituacao' => 1])->orderBy('uni_nomeabreviado')->all();
	    $ano              = Ano::find()->orderBy(['an_codano'=>SORT_DESC])->all();
	    $tipoPlanilha     = Tipoplanilha::find()->all();
	    $situacaoPlanilha = Situacaoplanilha::find()->all();
	    $tipoProgramacao  = Tipoprogramacao::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            if($model->relat_modelorelatorio == 1){
                return $this->redirect(['relatorio-geral-modelo-1', 'combounidade' => $model->relat_unidade, 'ano_planilha' => $model->relat_codano, 'situacao_planilha' => $model->relat_codsituacao, 'tipo_planilha' => $model->relat_codtipla, 'modelorelatorio' => $model->relat_modelorelatorio, 'combotipoprogramacao' => $model->relat_tipoprogramacao]);
                    }
            else if($model->relat_modelorelatorio == 2){
                return $this->redirect(['relatorio-geral-modelo-2', 'combounidade' => $model->relat_unidade, 'ano_planilha' => $model->relat_codano, 'situacao_planilha' => $model->relat_codsituacao, 'tipo_planilha' => $model->relat_codtipla, 'modelorelatorio' => $model->relat_modelorelatorio, 'combotipoprogramacao' => $model->relat_tipoprogramacao]);
                    }
        }else{
	            return $this->render('/relatorios/relatorio-geral/gerar-relatorio', [
	                'model'            => $model,
	                'unidades'         => $unidades,
	                'ano'              => $ano,
	                'tipoPlanilha'     => $tipoPlanilha,
	                'situacaoPlanilha' => $situacaoPlanilha,
	                'tipoProgramacao'  => $tipoProgramacao,
	                ]);
	         }
    }

    public function actionRelatorioGeralModelo1($combounidade, $ano_planilha, $situacao_planilha, $tipo_planilha, $modelorelatorio, $combotipoprogramacao)
    {
       $this->layout = 'main-imprimir';
       $combounidade         = $this->findModelUnidade($combounidade);
       $ano_planilha         = $this->findModelAnoPlanilha($ano_planilha);
       $situacao_planilha    = $this->findModelSituacaoPlanilha($situacao_planilha);
       $tipo_planilha        = $this->findModelTipoPlanilha($tipo_planilha);
       $modelorelatorio      = $modelorelatorio;
       $combotipoprogramacao = $this->findModelTipoProgramacao($combotipoprogramacao);

            return $this->render('/relatorios/relatorio-geral/relatorio-geral-modelo-1', [
              'combounidade'         => $combounidade,
              'ano_planilha'         => $ano_planilha, 
              'situacao_planilha'    => $situacao_planilha,
              'tipo_planilha'        => $tipo_planilha,
              'combotipoprogramacao' => $combotipoprogramacao,
              ]);
    }

    public function actionRelatorioGeralModelo2($combounidade, $ano_planilha, $situacao_planilha, $tipo_planilha, $modelorelatorio, $combotipoprogramacao)
    {

       $this->layout = 'main-imprimir';
       $combounidade         = $this->findModelUnidade($combounidade);
       $ano_planilha         = $this->findModelAnoPlanilha($ano_planilha);
       $situacao_planilha    = $this->findModelSituacaoPlanilha($situacao_planilha);
       $tipo_planilha        = $this->findModelTipoPlanilha($tipo_planilha);
       $modelorelatorio      = $modelorelatorio;
       $combotipoprogramacao = $this->findModelTipoProgramacao($combotipoprogramacao);


             return $this->render('/relatorios/relatorio-geral/relatorio-geral-modelo-2', [
              'combounidade'         => $combounidade,
              'ano_planilha'         => $ano_planilha, 
              'situacao_planilha'    => $situacao_planilha,
              'tipo_planilha'        => $tipo_planilha,
              'combotipoprogramacao' => $combotipoprogramacao,
              ]);
    }

    public function actionRelatorioGeralModelo2Psg($combounidade, $ano_planilha, $situacao_planilha, $tipo_planilha, $modelorelatorio, $combotipoprogramacao)
    {

       $this->layout = 'main-imprimir';
       $combounidade         = $this->findModelUnidade($combounidade);
       $ano_planilha         = $this->findModelAnoPlanilha($ano_planilha);
       $situacao_planilha    = $this->findModelSituacaoPlanilha($situacao_planilha);
       $tipo_planilha        = $this->findModelTipoPlanilha($tipo_planilha);
       $modelorelatorio      = $modelorelatorio;
       $combotipoprogramacao = $this->findModelTipoProgramacao($combotipoprogramacao);

            return $this->render('/relatorios/relatorio-geral/relatorio-geral-modelo-2-psg', [
              'combounidade'         => $combounidade,
              'ano_planilha'         => $ano_planilha, 
              'situacao_planilha'    => $situacao_planilha,
              'tipo_planilha'        => $tipo_planilha,
              'combotipoprogramacao' => $combotipoprogramacao,
              ]);
    }

    public function actionRelatorioGeralModelo2NaoPsg($combounidade, $ano_planilha, $situacao_planilha, $tipo_planilha, $modelorelatorio, $combotipoprogramacao)
    {

       $this->layout = 'main-imprimir';
       $combounidade         = $this->findModelUnidade($combounidade);
       $ano_planilha         = $this->findModelAnoPlanilha($ano_planilha);
       $situacao_planilha    = $this->findModelSituacaoPlanilha($situacao_planilha);
       $tipo_planilha        = $this->findModelTipoPlanilha($tipo_planilha);
       $modelorelatorio      = $modelorelatorio;
       $combotipoprogramacao = $this->findModelTipoProgramacao($combotipoprogramacao);

            return $this->render('/relatorios/relatorio-geral/relatorio-geral-modelo-2-nao-psg', [
              'combounidade'         => $combounidade,
              'ano_planilha'         => $ano_planilha, 
              'situacao_planilha'    => $situacao_planilha,
              'tipo_planilha'        => $tipo_planilha,
              'combotipoprogramacao' => $combotipoprogramacao,
              ]);
    }

    protected function findModelUnidade($combounidade)
    {
        $queryUnidade = "SELECT placu_codunidade, placu_nomeunidade FROM planilhadecurso_placu WHERE placu_codunidade = '".$combounidade."'";

        $combounidade = Planilhadecurso::findBySql($queryUnidade)->one();

        return $combounidade;
    }

    protected function findModelAnoPlanilha($ano_planilha)
    {
        $queryAno = "SELECT * FROM ano_an WHERE an_codano = '".$ano_planilha."'";

        if (($ano_planilha = Ano::findBySql($queryAno)->one()) !== null) {
            return $ano_planilha;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    protected function findModelSituacaoPlanilha($situacao_planilha)
    {
        $querySituacaoPlanilha = "SELECT * FROM situacaoplanilha_sipla WHERE sipla_codsituacao = '".$situacao_planilha."'";

        if (($situacao_planilha = Situacaoplanilha::findBySql($querySituacaoPlanilha)->one()) !== null ) {
            return $situacao_planilha;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    protected function findModelTipoPlanilha($tipo_planilha)
    {
        $queryTipoPlanilha = "SELECT * FROM tipoplanilha_tipla WHERE tipla_codtipla = '".$tipo_planilha."'";

        if (($tipo_planilha = Tipoplanilha::findBySql($queryTipoPlanilha)->one()) !== null ) {
            return $tipo_planilha;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    protected function findModelTipoProgramacao($combotipoprogramacao)
    {
        $queryTipoProgramacao = "SELECT * FROM tipoprogramacao_tipro WHERE tipro_codprogramacao = '".$combotipoprogramacao."'";

        if (($combotipoprogramacao = Tipoprogramacao::findBySql($queryTipoProgramacao)->one()) !== null) {
            return $combotipoprogramacao;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    public function AccessAllow()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }
}