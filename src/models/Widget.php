<?php

namespace ashch\sitecore\models;

use Yii;
use ashch\sitecore\components\ActiveRecord;

/**
 * This is the model class for table "{{%widget}}".
 *
 * @property int $id ID
 * @property string $slug Slug
 * @property string $widget_class Widget Class
 * @property string $name Name
 * @property string $description Description
 * @property int $active Active
 * @property int $sorting Sorting
 * @property string $image Image
 * @property int $created_by Created by:
 * @property int $updated_by Updated by:
 * @property int $created_at Created at:
 * @property int $updated_at Updated at:
 *
 * @property PageContent[] $pageContents
 */
class Widget extends ActiveRecord
{

    protected static $imageUrl = '/backend/web/images/widget/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%widget}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['active', 'sorting', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'widget_class'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'widget_class' => Yii::t('app', 'Widget Class'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'sorting' => Yii::t('app', 'Sorting'),
            'image' => Yii::t('app', 'Image'),
            'created_by' => Yii::t('app', 'Created by:'),
            'updated_by' => Yii::t('app', 'Updated by:'),
            'created_at' => Yii::t('app', 'Created at:'),
            'updated_at' => Yii::t('app', 'Updated at:'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageContents()
    {
        return $this->hasMany(PageContent::className(), ['widget_id' => 'id']);
    }

    public function getSmallImageUrl()
    {
        return self::$imageUrl . $this->image;
    }

}
