<?php

namespace app\modules\aux_planejamento\controllers\repositorio;

use Yii;
use app\modules\aux_planejamento\models\repositorio\Elementodespesa;
use app\modules\aux_planejamento\models\repositorio\Tipomaterial;
use app\modules\aux_planejamento\models\repositorio\TipomaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * TipomaterialController implements the CRUD actions for Tipomaterial model.
 */
class TipomaterialController extends Controller
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
     * Lists all Tipomaterial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipomaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipomaterial model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Localiza os dados de elementos de despesa cadastrados no repositorio
    public function actionGetElementoDespesa($eledId){

        $getElementodespesa = Elementodespesa::findOne($eledId);

        echo Json::encode($getElementodespesa);
    }

    /**
     * Creates a new Tipomaterial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tipomaterial();

        $elementodespesa = Elementodespesa::find()->where(['eled_status' => 1])->orderBy('eled_despesa')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Tipo de Material cadastrado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'elementodespesa' => $elementodespesa,
            ]);
        }
    }

    /**
     * Updates an existing Tipomaterial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $elementodespesa = Elementodespesa::find()->where(['eled_status' => 1])->orderBy('eled_despesa')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Tipo de Material atualizado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'elementodespesa' => $elementodespesa,
            ]);
        }
    }

    /**
     * Deletes an existing Tipomaterial model.
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
     * Finds the Tipomaterial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tipomaterial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tipomaterial::findOne($id)) !== null) {
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
