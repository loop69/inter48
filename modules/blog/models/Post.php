<?php

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $category_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content', 'category_id', 'status'], 'required'],
            [['user_id', 'category_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUserName()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
