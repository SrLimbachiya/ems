<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_state".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 */
class StateMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'country_id' => 'Country ID',
        ];
    }

    public static function getAllStates() {
        $models = self::find()->cache(0)->select(['id', 'name'])->all();
        $finalData = [];
        foreach ($models as $model) {
            $finalData[$model->id] = $model->name;
        }
        return $finalData;
    }

    public static function getStateById($id) {
        $allCities = self::getAllStates();
        if (!empty($allCities[$id])) {
            return $allCities[$id];
        }
        return "NA";
    }
}
