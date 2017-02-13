<?php

namespace app\modules\aux_planejamento\controllers\planilhas;

use Yii;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoPendentes;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoPendentesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanilhadecursoPendentesController implements the CRUD actions for PlanilhadecursoPendentes model.
 */
class PlanilhadecursoPendentesController extends Controller
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
     * Lists all PlanilhadecursoPendentes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-planilhadecurso';
        $searchModel = new PlanilhadecursoPendentesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanilhadecursoPendentes model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsPlaniDespDocente    = $model->planiDespDocente;
        $modelsPlaniUC             = $model->planiUC;
        $modelsPlaniMaterial       = $model->planiMateriais;
        $modelsPlaniConsumo        = $model->planiConsumo;
        $modelsPlaniMateriaisAluno = $model->planiMateriaisAluno;
        $modelsPlaniEquipamento    = $model->planiEquipamento;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelsPlaniDespDocente'    => $modelsPlaniDespDocente,
            'modelsPlaniUC'             => $modelsPlaniUC,
            'modelsPlaniMaterial'       => $modelsPlaniMaterial,
            'modelsPlaniConsumo'        => $modelsPlaniConsumo,
            'modelsPlaniMateriaisAluno' => $modelsPlaniMateriaisAluno,
            'modelsPlaniEquipamento'    => $modelsPlaniEquipamento,
        ]);
    }

    //Homologa todo o Planejamento da unidade selecionada para o MODELO A
    public function actionHomologarPlanejamento() 
    {
        $model = new PlanilhadecursoPendentes();

        $unidades = Unidade::find()->where(['uni_codsituacao' => 1])->orderBy('uni_nomeabreviado')->all();
        $tipoProgramacao = Tipoprogramacao::find()->all();

     if ($model->load(Yii::$app->request->post())) {

        //Realiza a Contagem das Planilhas da unidade que estão definidas como como PRODUÇÃO(1), PROGRAMAÇÃO ANUAL(1) e EM ANÁLISE PELO GPO - SITUAÇÃO COD 3
        $countPlanilhas = 0;
        $countPlanilhas = Planilhadecurso::find()->where(['placu_codtipla' => 1, 'placu_codsituacao' => 3,  'placu_codprogramacao' => $model->placu_codprogramacao,  'placu_codunidade' =>  $model->placu_codunidade])->count();

            //Altera a situação de todas as planilhas da unidade selecionada
        if($countPlanilhas != 0){
                Yii::$app->db_apl->createCommand()
                    ->update('planilhadecurso_placu', [
                             'placu_codsituacao' => 4, //Homologado pelo GPO
                             ], [//------WHERE
                             'placu_codtipla' => 1,  //PRODUÇÃO(1)
                             'placu_codsituacao' => 3, //EM ANÁLISE PELO GPO
                             'placu_codprogramacao' => $model->placu_codprogramacao, // PROGRAMAÇÃO ANUAL
                             'placu_codunidade' => $model->placu_codunidade, // Unidade selecionada
                             ]) 
                    ->execute();
        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Total de '.$countPlanilhas.' planilhas do tipo <strong>'.$model->tipoprogramacao->tipro_descricao.'</strong> da unidade <strong>'.$model->unidade->uni_nomeabreviado.'</strong> Homologadas pelo GPO!</strong>');
        }else{
            Yii::$app->session->setFlash('warning', '<strong>AVISO! </strong> Não existem planilhas da unidade <strong>'.$model->unidade->uni_nomeabreviado.'</strong> do tipo <strong>'.$model->tipoprogramacao->tipro_descricao.'</strong> com a situação: <strong>"Em análise pela GPO"</strong> para serem Homologadas!</strong>');
        }

        return $this->redirect(['/planilhas/planilhadecurso-pendentes/index']);

        }else{
            return $this->renderAjax('homologar-planejamento', [
                'model' => $model,
                'unidades'=> $unidades,
                'tipoProgramacao' => $tipoProgramacao,
            ]);
        }

    }

    /**
     * Creates a new PlanilhadecursoPendentes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanilhadecursoPendentes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->placu_codplanilha]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCorrecao($id) 
    {
        $model = Planilhadecurso::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_planilhadecurso', $model->placu_codplanilha);

        return $this->redirect(['planilhas/planilha-justificativas/index'], [
             'model' => $model,
         ]);
    }

    /**
     * Updates an existing PlanilhadecursoPendentes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->placu_codplanilha]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PlanilhadecursoPendentes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlanilhadecursoPendentes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlanilhadecursoPendentes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanilhadecursoPendentes::findOne($id)) !== null) {
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