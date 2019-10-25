<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property Products[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'status' => 'Статус',
        ];
    }

    public static function getStatusText()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DISABLED => 'Неактивный'
        ];
    }

    public static function getArrayForSidebar()
    {
        $result = [];
        $categories = Category::find()->all();
        foreach ($categories as $category) {
            $result[] = ['label' => $category->name, 'url' => '?category_id='.$category->id];
        }
        return $result;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['category_id' => 'id']);
    }
}