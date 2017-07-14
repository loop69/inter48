<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $name
 * @property string $comment
 * @property string $date_add
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'name', 'comment', 'date_add'], 'required'],
            [['post_id', 'user_id', 'parent_id'], 'integer'],
            [['comment'], 'string'],
            [['date_add'], 'safe'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'comment' => Yii::t('app', 'Comment'),
            'date_add' => Yii::t('app', 'Date Add'),
        ];
    }
}
