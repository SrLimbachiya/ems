<?php

namespace app\models;

use components\Masters;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "designation_master".
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $ip
 */
class Designations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designation_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
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

    public static function resolveDesignationName($desId) {
        $model = self::findOne($desId);
        if (!empty($model)) {
            return $model->name;
        }
        return 'NA';
    }

    public static function getAllActive() {
        $models = self::find()->where(['status' => Masters::STATUS_ACTIVE])->all();
        $finalData = [];
        foreach ($models as $model) {
            $finalData[$model->id] = $model->name;
        }
        return $finalData;
    }
}
