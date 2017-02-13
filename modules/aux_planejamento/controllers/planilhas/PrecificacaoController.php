<?php

namespace app\modules\aux_planejamento\controllers\planilhas;

use Yii;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\despesas\Markup;
use app\modules\aux_planejamento\models\despesas\MarkupSearch;
use app\modules\aux_planejamento\models\despesas\Despesasdocente;
use app\modules\aux_planejamento\models\despesas\Custosunidade;
use app\modules\aux_planejamento\models\planos\Planodeacao;
use app\modules\aux_planejamento\models\planilhas\PrecificacaoUnidades;
use app\modules\aux_planejamento\models\planilhas\Precificacao;
use app\modules\aux_planejamento\models\planilhas\PrecificacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
//use mPDF;

/**
 * PrecificacaoController implements the CRUD actions for Precificacao model.
 */
class PrecificacaoController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Precificacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrecificacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDuvidas()
    {
        return $this->renderAjax('duvidas');
    }

    public function actionImprimir($id) {

            $model = $this->findModel($id);

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_A4,
                'content' => $this->renderPartial('imprimir', ['model' => $model]),
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                'cssInline'=> '.kv-heading-1{font-size:18px}',
                'defaultFontSize' => '6px',
                'options' => [
                    'title' => 'Gerência de Planejamento e Orçamento - GPO',
                ],
                'methods' => [
                    'SetHeader' => ['DETALHES DA PRECIFICAÇÃO DE CUSTO - SENAC AM||Gerado em: ' . date("d/m/Y - H:i:s")],
                    'SetFooter' => ['Gerência de Planejamento e Orçamento - GPO||Página {PAGENO}'],
                ]
            ]);

        return $pdf->render('imprimir', [
            'model' => $model,

        ]);
        }

    /**
     * Displays a single Precificacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    //Localiza os dados de custos indiretos da unidade escolhida
    public function actionGetMarkup($markup){

        $getmarkup = Markup::find()->where(['mark_codunidade' => $markup])->one();

        echo Json::encode($getmarkup);
    }


    //Localiza os dados do Plano
    public function actionGetPlano($plano){

        $getPlano = Planodeacao::find()->where(['plan_codplano' => $plano])->one();

        echo Json::encode($getPlano);
    }

    //Localiza os dados de nível de docente
    public function actionGetNivelDocente($niveldocente){

        $getnivelDocente = Despesasdocente::find()->where(['doce_id' => $niveldocente])->one();

        echo Json::encode($getnivelDocente);
    }

    /**
     * Creates a new Precificacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        $model = new Precificacao();
        $precificacaoUnidades = new PrecificacaoUnidades();

        $sourceMarkup = new MarkupSearch();
        $dataProvider = $sourceMarkup->search(Yii::$app->request->getQueryParams());
        $markups = $dataProvider->getModels();

        $planos       = Planodeacao::find()->where(['plan_status' => 1])->orderBy('plan_descricao')->all();
        $unidades     = Unidade::find()->where(['uni_codsituacao' => 1, 'uni_coddisp' => 1])->orderBy('uni_nomeabreviado')->all();
        $nivelDocente = Despesasdocente::find()->where(['doce_status' => 1])->all();

        $model->planp_ano            = date('Y');
        $model->planp_data           = date('Y-m-d');
        $model->planp_codcolaborador = $session['sess_codcolaborador'];

        //Realiza a Verificação se as configurações estão atualizadas do Markup
        foreach ($markups as $markup) {
                    if($markup->mark_ano != date('Y')){
                         Yii::$app->session->setFlash('danger', "As Configurações de Markup estão configuradas para o ano de <strong>" .$markup->mark_ano. "</strong>. Por gentileza, atualize as informações para o ano corrente(" .date('Y').") na tela de Configuração de Markup.<strong> clicando aqui</strong>!" );

                         return $this->render('create', [
                            'model' => $model,
                            'precificacaoUnidades' => $precificacaoUnidades,
                            'planos' => $planos,
                            'unidades' => $unidades,
                            'nivelDocente' => $nivelDocente,
                        ]);
                    }else{
                        Yii::$app->session->removeFlash('danger',null);
                    }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        //Realiza a Verificação se as configurações estão atualizadas do Markup
        foreach ($markups as $markup) {
                    if($markup->mark_ano != date('Y')){
                         Yii::$app->session->setFlash('danger', "As Configurações de Markup estão configuradas para o ano de <strong>" .$markup->mark_ano. "</strong>. Por gentileza, atualize as informações para o ano corrente(" .date('Y').") na tela de Configuração de Markup.<strong> clicando aqui</strong>!" );
                    }else{
                        Yii::$app->session->removeFlash('danger',null);
                    }
        }

            if($model->save()){

                $model->planp_totalcustodireto = $model->planp_totalsalarioencargo + $model->planp_diarias + $model->planp_passagens + $model->planp_pessoafisica + $model->planp_pessoajuridica + $model->planp_PJApostila + $model->planp_custosmateriais + $model->planp_custosconsumo;

                //Localiza as unidades configuradas pelo MARKUP
                $listagemUnidades = "SELECT * FROM markup_mark";
                $unidadesMarkup = Markup::findBySql($listagemUnidades)->all();

                foreach ($unidadesMarkup as $unidadeMarkup) {

                    $mark_codunidade = $unidadeMarkup['mark_codunidade'];
                    $mark_divisor    = $unidadeMarkup['mark_divisor'];

                    $PrecoVendaTurma    = ($model->planp_totalcustodireto / $mark_divisor) * 100; // Valores em % -> Preço de Venda = Total Custo Direto / Markup Divisor
                    $PrecoVendaAluno    = $PrecoVendaTurma / $model->planp_qntaluno; //Preço de Venda da Turma / QNT Alunos
                    $ValorHoraAulaAluno = $PrecoVendaTurma / $model->planp_cargahoraria / $model->planp_qntaluno; //Preço de Venda da Turma / CH TOTAL / QNT Alunos

                    $command = Yii::$app->db_apl->createCommand();
                    $command->insert('db_apl2.precificacao_unidades', array('uprec_codunidade'=>$mark_codunidade, 'precificacao_id' => $model->planp_id, 'uprec_cargahoraria' => $model->planp_cargahoraria, 'uprec_qntaluno' => $model->planp_qntaluno, 'uprec_totalcustodireto' => $model->planp_totalcustodireto, 'uprec_vendaturma' => $PrecoVendaTurma, 'uprec_vendaaluno' => $PrecoVendaAluno, 'uprec_horaaula' => $ValorHoraAulaAluno));
                    $command->execute();

                    }

                    $precificacaoUnidades->save();
                }

                Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Precificação de Custo criada!</strong>');

            return $this->redirect(['view', 'id' => $model->planp_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'precificacaoUnidades' => $precificacaoUnidades,
                'planos' => $planos,
                'unidades' => $unidades,
                'nivelDocente' => $nivelDocente,
            ]);
        }
    }

    /**
     * Updates an existing Precificacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;

        $model = $this->findModel($id);

        $planos       = Planodeacao::find()->where(['plan_status' => 1])->orderBy('plan_descricao')->all();
        $unidades     = Unidade::find()->where(['uni_codsituacao' => 1, 'uni_coddisp' => 1])->orderBy('uni_nomeabreviado')->all();
        $nivelDocente = Despesasdocente::find()->where(['doce_status' => 1])->all();

        $model->planp_data           = date('Y-m-d');
        $model->planp_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->planp_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'planos' => $planos,
                'unidades' => $unidades,
                'nivelDocente' => $nivelDocente,
            ]);
        }
    }

    /**
     * Deletes an existing Precificacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Precificacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Precificacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Precificacao::findOne($id)) !== null) {
            return $model;
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