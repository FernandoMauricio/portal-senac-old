<?php

namespace app\modules\aux_planejamento\controllers\relatorios;

use Yii;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\relatorios\RelatorioModeloB;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;


class RelatorioModeloBController extends Controller
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
	    $model = new RelatorioModeloB();

	    $unidades = Unidade::find()->where(['uni_codsituacao' => 1])->orderBy('uni_nomeabreviado')->all();
	    $ano      = Ano::find()->orderBy(['an_codano'=>SORT_DESC])->all();

        if ($model->load(Yii::$app->request->post())) {

                return $this->redirect(['relatorio-modelo-b', 'combo_unidade' => $model->relat_unidade, 'combo_ano' => $model->relat_codano]);
        }else{

	            return $this->render('/relatorios/relatorio-modelo-b/gerar-relatorio', [
	                'model'            => $model,
	                'unidades'         => $unidades,
	                'ano'              => $ano,
	                ]);
	        }
    }

    public function actionRelatorioModeloB($combo_unidade, $combo_ano)
    {
       $this->layout = 'main-imprimir';
       $combo_unidade         = $this->findModelUnidade($combo_unidade);
       $combo_ano         = $this->findModelAnoPlanilha($combo_ano);

             return $this->render('/relatorios/relatorio-modelo-b/relatorio-modelo-b', [
              'combo_unidade'         => $combo_unidade,
              'combo_ano'         => $combo_ano, 
              ]);
    }

    protected function findModelUnidade($combo_unidade)
    {
        $queryUnidade = "SELECT placu_codunidade, placu_nomeunidade FROM planilhadecurso_placu WHERE placu_codunidade = '".$combo_unidade."'";

        $combo_unidade = Planilhadecurso::findBySql($queryUnidade)->one();

        return $combo_unidade;
    }

    protected function findModelAnoPlanilha($combo_ano)
    {
        $queryAno = "SELECT * FROM ano_an WHERE an_codano = '".$combo_ano."'";

        if (($combo_ano = Ano::findBySql($queryAno)->one()) !== null) {
            return $combo_ano;
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