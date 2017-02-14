<?php

namespace app\modules\siteadmin\controllers;

use Yii;
use app\modules\siteadmin\models\vestibular\Vestibular;
use app\modules\siteadmin\models\vestibular\VestibularSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VestibularController implements the CRUD actions for Vestibular model.
 */
class VestibularController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vestibular models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){

        $searchModel = new VestibularSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Displays a single Vestibular model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vestibular model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){
    
        $model = new Vestibular();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Updates an existing Vestibular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idVest]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Deletes an existing Vestibular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionInformacoes($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/informacoes/index', [
             'model' => $model,
         ]);
    }

    public function actionEditais($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/editais/index', [
             'model' => $model,
         ]);
    }

    public function actionFichasInscricoes($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/fichas-inscricoes/index', [
             'model' => $model,
         ]);
    }

    public function actionGabarito($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/gabarito/index', [
             'model' => $model,
         ]);
    }

    public function actionAprovados($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/aprovados/index', [
             'model' => $model,
         ]);
    }

    public function actionMatriz($id) 
    {

        $model = Vestibular::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_vestibular', $model->idVest);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=vestibular/matriz/index', [
             'model' => $model,
         ]);
    }

    /**
     * Finds the Vestibular model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vestibular the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vestibular::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
