<?php

namespace app\modules\aux_planejamento\controllers\despesas;

use Yii;
use yii\base\Model;
use app\modules\aux_planejamento\models\despesas\Custosunidade;
use app\modules\aux_planejamento\models\despesas\Markup;
use app\modules\aux_planejamento\models\despesas\MarkupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarkupController implements the CRUD actions for Markup model.
 */
class MarkupController extends Controller
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
     * Lists all Markup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarkupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Markup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionBatchUpdate()
    {
        $sourceModel = new MarkupSearch();
        $dataProvider = $sourceModel->search(Yii::$app->request->getQueryParams());
        $models = $dataProvider->getModels();

        //Realiza a Verificação se as configurações estão atualizadas do Markup
        foreach ($models as $model) {
                    if($model->mark_ano != date('Y')){
                         Yii::$app->session->setFlash('danger', "Alguns Custos das Unidades estão desatualizados. Por favor, atualize as informações para o ano de<strong> ".date('Y')."</strong> na tela de <strong> Custos da Unidade</strong>!" );
                    }
        }

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $index => $model) {

                //localiza o custo indireto de cada unidade
                $listagemCustos = "SELECT * FROM custosunidade_cust WHERE cust_ano = ".date('Y')." AND cust_codunidade = ".$model->mark_codunidade."";
                $custos = Custosunidade::findBySql($listagemCustos)->all(); 

                    foreach ($custos as $custo) {
                        $cust_MediaPorcentagem = $custo['cust_MediaPorcentagem'];
                        $cust_ano = $custo['cust_ano'];

                // populate and save records for each model
                $model->mark_custoindireto = $cust_MediaPorcentagem;
                $model->mark_ano = $cust_ano;
                $model->mark_totalincidencias = $model->mark_custoindireto + $model->mark_ipca + $model->mark_reservatecnica + $model->mark_despesasede;
                $model->mark_divisor = (100 - $model->mark_totalincidencias);

                }
                if ($model->save()) {
                    $count++;
                }
            }
            
            Yii::$app->session->removeFlash('danger',null);
            Yii::$app->session->setFlash('success', "Configurações Atualizadas!");

            return $this->redirect(['batch-update']); // redirect to your next desired page
        } else {
            return $this->render('update', [
                'model'=>$sourceModel,
                'dataProvider'=>$dataProvider
            ]);
        }
    }

    /**
     * Creates a new Markup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Markup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mark_id]);
        } else {      

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Markup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mark_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Markup model.
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
     * Finds the Markup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Markup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Markup::findOne($id)) !== null) {
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