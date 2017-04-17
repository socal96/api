<?php

namespace app\controllers;

use app\models\SendBalanceForm;
use app\models\User;
use app\models\UserBalance;
use Yii;
use app\models\Transactions;
use app\models\TransactionsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionsController implements the CRUD actions for Transactions model.
 */
class TransactionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['my-transactions', 'send-balance','balance'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'create','update','delete','view'],
                        'allow' => User::isAdmin(),
                        'roles' => ['@'],
                    ]
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIndex()
    {

            $searchModel = new TransactionsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

    }

    /**
     * Displays a single Transactions model.
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
     * Creates a new Transactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transactions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transactions model.
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
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transactions model.
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
     * Finds the Transactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Transactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transactions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists user all Transactions models.
     * @return mixed
     */
    public function actionMyTransactions()
    {
        $searchModel = new TransactionsSearch();
        $dataProvider = $searchModel->my_tran_search(Yii::$app->request->queryParams);

        return $this->render('my_transactions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /*end*/
    /**
     * Action for User, new Transaction.
     * @return mixed
     */
    public function actionSendBalance()
    {
        $model = new SendBalanceForm();
        $tranzaction_id = null;
        if ($model->load(Yii::$app->request->post())) {

                if($model->sendBalance($tranzaction_id))
                {
                    return $this->redirect(['my-transactions']);
                }else
                {
                    return $this->render('send_balance', [
                        'model' => $model,
                    ]);
                }

        } else {
            return $this->render('send_balance', [
                'model' => $model,
            ]);
        }
    }
    /*end*/
    /**
     * Action for User, new Transaction.
     * @return mixed
     */
    public function actionBalance()
    {
        $balance=UserBalance::findOne(["user_id"=>Yii::$app->user->id]);
        return $this->render("my_balance",["balance"=>$balance]);
    }
    /*end*/
}
