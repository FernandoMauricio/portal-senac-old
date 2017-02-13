<?php

namespace app\modules\aux_planejamento\controllers\planilhas;

use Yii;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoHomologadas;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoHomologadasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanilhadecursoHomologadasController implements the CRUD actions for PlanilhadecursoHomologadas model.
 */
class PlanilhadecursoHomologadasController extends Controller
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
     * Lists all PlanilhadecursoHomologadas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-planilhadecurso';
        $searchModel = new PlanilhadecursoHomologadasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanilhadecursoHomologadas model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsPlaniDespDocente = $model->planiDespDocente;
        $modelsPlaniUC          = $model->planiUC;
        $modelsPlaniMaterial    = $model->planiMateriais;
        $modelsPlaniConsumo     = $model->planiConsumo;
        $modelsPlaniEquipamento = $model->planiEquipamento;

        return $this->render('/planilhas/planilhadecurso/view-admin', [
            'model' => $this->findModel($id),
            'modelsPlaniDespDocente' => $modelsPlaniDespDocente,
            'modelsPlaniUC'          => $modelsPlaniUC,
            'modelsPlaniMaterial'    => $modelsPlaniMaterial,
            'modelsPlaniConsumo'     => $modelsPlaniConsumo,
            'modelsPlaniEquipamento' => $modelsPlaniEquipamento,
        ]);
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
     * Creates a new PlanilhadecursoHomologadas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanilhadecursoHomologadas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->placu_codplanilha]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlanilhadecursoHomologadas model.
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
     * Deletes an existing PlanilhadecursoHomologadas model.
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
     * Finds the PlanilhadecursoHomologadas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlanilhadecursoHomologadas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanilhadecursoHomologadas::findOne($id)) !== null) {
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