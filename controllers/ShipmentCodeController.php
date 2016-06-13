<?php

namespace app\controllers;

use Yii;
use app\models\ShipmentCode;
use app\models\ShipmentCodeSearch;
use yii\filters\AccessControl;
use yii\web\ConflictHttpException;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShipmentCodeController implements the CRUD actions for ShipmentCode model.
 */
class ShipmentCodeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['*'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        //'verbs' => ['POST']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ShipmentCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShipmentCodeSearch();
//        die(var_dump(Yii::$app->request->queryParams));
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShipmentCode model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShipmentCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $sid = Yii::$app->request->getQueryParam('sid');
        if(!is_numeric($sid) || $sid<1)
            throw new NotAcceptableHttpException();

        $model = new ShipmentCode();
        $model->shipment_id = $sid;
        $model->load(Yii::$app->request->post());
        $model->input_time = null;

        if ($model->save()) {
            return $this->redirect(['shipment/view', 'id' => $model->shipment_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ShipmentCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['shipment/view', 'id' => $model->shipment_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShipmentCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $shipment_id = $model->shipment_id;

        $model->delete();

        return $this->redirect(['shipment/view', 'id' => $shipment_id]);

//        return $this->redirect(['index']);
    }

    /**
     * Finds the ShipmentCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ShipmentCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShipmentCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
