<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\helpers\Html;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property string|null $data_id Primary key of the data that has been updated/added
 * @property string|null $log_type Type of log create/update/delete
 * @property string|null $section_name Section such as employee record, department, designation
 * @property string|null $values Updated attributes
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Logs extends ActiveRecord
{

    const TYPE_CREATED = 'Added';
    const TYPE_UPDATED = 'Updated';
    const TYPE_DELETED = 'Deleted';


    const SECTION_EMPLOYEE = 'Employee Record';
    const SECTION_DEPARTMENT = 'Department';
    const SECTION_DESIGNATION = 'Designation';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['values'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['data_id'], 'string', 'max' => 190],
            [['log_type', 'section_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_id' => 'Data ID',
            'log_type' => 'Log Type',
            'section_name' => 'Section Name',
            'values' => 'Values',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(), //BlameableBehavior automatically fills the specified attributes with the current user ID.
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public static function addLog($model = [], $oldAttributes = [],  $logType = "", $sectionName = null, $dataId = null)
    {
        $array = [];
        $logModel = new Logs();
        $logModel->log_type = $logType;
        $logModel->section_name = $sectionName;
        $logModel->data_id = (string)$dataId;
        if (!is_array($model)) {
            $modelAttributes = $model->getAttributes();
        } else {
            $modelAttributes = $oldAttributes;
        }

        $objArray = [];
        if ($logType == self::TYPE_CREATED || $logType == self::TYPE_DELETED) {
            foreach ($modelAttributes as $key => $val) {
                $objArray['key'] = $key;
                $objArray['value'] = $val;
                $objArray['label'] = $model->getAttributeLabel($key);
                array_push($array, $objArray);
            }
        } elseif ($logType == self::TYPE_UPDATED) {
            foreach ($modelAttributes as $key => $val) {
                if (array_key_exists($key, $oldAttributes) && $oldAttributes[$key] != $val) {
                    $objArray['key'] = $key;
                    $objArray['value'] = $oldAttributes[$key];
                    $objArray['label'] = $model->getAttributeLabel($key);
                    $objArray['newValue'] = $val;
                    array_push($array, $objArray);
                }
            }
        }
        $logModel->values = json_encode($array);
        if (!$logModel->save()) {
            Yii::$app->session->setFlash('danger', "Log Error \n".Html::errorSummary($logModel));
        }
    }
}