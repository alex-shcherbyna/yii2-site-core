<?php

namespace ashch\sitecore\models;

use Yii;
use ashch\sitecore\components\ActiveRecord;

/**
 * This is the model class for table "{{%lang}}".
 *
 * @property int $id ID
 * @property string $url Locale
 * @property string $locale Locale
 * @property string $name Name
 * @property string $short_name Short name
 * @property int $default Default
 * @property int $active Active
 * @property int $created_at Created at:
 * @property int $updated_at Updated at:
 */
class Lang extends ActiveRecord
{

    //Переменная, для хранения текущего объекта языка
    static $current = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lang}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'url', 'locale', 'name', 'name_short'], 'required'],
            [['id', 'default', 'active', 'created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 3],
            [['locale', 'short_name'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 50],
            [['locale'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'locale' => Yii::t('app', 'Locale'),
            'name' => Yii::t('app', 'Name'),
            'short_name' => Yii::t('app', 'Short name'),
            'default' => Yii::t('app', 'Default'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created at:'),
            'updated_at' => Yii::t('app', 'Updated at:'),
        ];
    }

    //Получение текущего объекта языка
    static function getCurrent()
    {
        if (self::$current === null) {
            self::$current = self::getLangByLocale();
        }
        return self::$current;
    }

//Установка текущего объекта языка и локаль пользователя
    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->locale;
        Yii::$app->params['lang'] = self::$current;
    }

//Получения объекта языка по умолчанию
    static function getDefaultLang()
    {
        return Lang::find()->where('`default` = :default', [':default' => 1])->one();
    }

//Получения всех языков в массив 
    static function getAllLangs()
    {
        return Lang::find()->select(['name', 'locale'])->indexBy('locale')->column();
    }

//Получения объекта языка по буквенному идентификатору
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Lang::find()->where('url = :url', [':url' => $url])->one();
            if ($language === null) {
                return null;
            } else {
                return $language;
            }
        }
    }

//Получения объекта языка по буквенному идентификатору Locale
    static function getLangByLocale($locale_id = null)
    {
        if (empty($locale_id))
            $locale_id = \Yii::$app->language;
        $language = Lang::find()->where('locale = :locale', [':locale' => $locale_id])->one();
        if ($language === null) {
            return null;
        } else {
            return $language;
        }
    }

    public static function getLangMenuItems()
    {
        $langs = Lang::find()->select('url, short_name')
                        ->where('id != :current_id', [':current_id' => self::getCurrent()->id])
                        ->andWhere(['active' => 1])
                        ->asArray()->all();
        $langItems = [];
        foreach ($langs AS $lang) {
            $langItems[] = [
                'label' => $lang['short_name'],
                'url' => "/{$lang['url']}" . Yii::$app->getRequest()->getLangUrl(),
            ];
        }
        return $langItems;
    }

}
