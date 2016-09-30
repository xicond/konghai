<?php

namespace app\controllers;

use app\models\Tracker;
use Yii;
use app\models\Shipment;
use app\models\ShipmentCode;
use app\models\ShipmentSearch;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\Transaction;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ShipmentController implements the CRUD actions for Shipment model.
 */
class ShipmentController extends Controller
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
     * Lists all Shipment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShipmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shipment model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_code' => new ActiveDataProvider([
                'query' => ShipmentCode::find()
                ->where(['shipment_id' => $id])->andWhere(['delete_time' => null])->orderBy('input_time')
            ]),
            'model_tracker' => new ActiveDataProvider([
                'query' => Tracker::find()->where(['shipment_id' => $id])
            ])

        ]);
    }

    /**
     * Creates a new Shipment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shipment();
        $model_code = new ShipmentCode();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model_code->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ArrayHelper::merge( ActiveForm::validate($model_code), ActiveForm::validate($model));
        }

        $transaction = Yii::$app->db->beginTransaction(
            Transaction::SERIALIZABLE
        );
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if ($model_code->load(Yii::$app->request->post()) && ($model_code->shipment_id = $model->id) && $model_code->save()) {


                }
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);

            } //else {
                return $this->render('create', [
                    'model' => $model,
                    'model_code' => $model_code,
                ]);
            //}
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new BadRequestHttpException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Updates an existing Shipment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Shipment model.
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
     * Finds the Shipment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Shipment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shipment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
