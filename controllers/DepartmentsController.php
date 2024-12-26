<?php

namespace app\controllers;

use app\models\Departments;
use app\models\Employee;
use app\models\Logs;
use app\models\search\DepartmentsSearch;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentsController implements the CRUD actions for Departments model.
 */
class DepartmentsController extends Controller
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
     * Lists all Departments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departments model.
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
     * Creates a new Departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Departments();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Logs::addLog($model, [], Logs::TYPE_CREATED, Logs::SECTION_DEPARTMENT, $model->id);
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
     * Updates an existing Departments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldAttributes = $model->getAttributes();
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                Logs::addLog($model, $oldAttributes, Logs::TYPE_UPDATED, Logs::SECTION_DEPARTMENT, $model->id);
                \Yii::$app->getSession()->setFlash('success', 'Department has been updated successfully.');
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
     * Deletes an existing Departments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $checkEmp = Employee::find()->where(['department' => $id])->exists();
        $model = $this->findModel($id);
        if ($checkEmp) {
            \Yii::$app->getSession()->setFlash('danger', 'Department is associated with an employee, can not delete.');
        } else {
            if (!empty($model)) {
                Logs::addLog($model, [], Logs::TYPE_DELETED, Logs::SECTION_DEPARTMENT, $model->id);
                \Yii::$app->getSession()->setFlash('success', 'Department has been deleted.');
                $model->delete();
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Invalid Request.');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departments::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLogs() {
        $data = Logs::find()->where(['section_name' => Logs::SECTION_DEPARTMENT])->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render("logs", ['model' => [], 'data' => $data]);
    }
}
