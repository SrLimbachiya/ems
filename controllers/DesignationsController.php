<?php

namespace app\controllers;

use app\models\Designations;
use app\models\Employee;
use app\models\search\DesignationsSearch;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesignationsController implements the CRUD actions for Designations model.
 */
class DesignationsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Designations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DesignationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Designations model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Designations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Designations();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    \Yii::$app->getSession()->setFlash('success', 'Department created successfully.');
                    return $this->redirect(['index']);
                } else {
                    \Yii::$app->getSession()->setFlash('danger', Html::errorSummary($model));
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Designations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Designation has been updated successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::$app->getSession()->setFlash('danger', Html::errorSummary($model));
                return $this->redirect(\Yii::$app->request->referrer);
            }
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Designations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $checkEmp = Employee::find()->where(['designation' => $id])->exists();
        if ($checkEmp) {
            \Yii::$app->getSession()->setFlash('danger', 'Designation is associated with an employee, can not delete.');
        } else {
            \Yii::$app->getSession()->setFlash('success', 'Designation has been deleted.');
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Designations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Designations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Designations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
