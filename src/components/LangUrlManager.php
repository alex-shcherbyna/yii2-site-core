<?php

namespace ashch\sitecore\components;

use yii\web\UrlManager;
use ashch\sitecore\models\Lang;

class LangUrlManager extends UrlManager
{

    public function createUrl($params)
    {

        if (isset($params['lang_id'])) {
            //Если указан идентефикатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию
            $lang = Lang::findOne($params['lang_id']);
            if ($lang === null) {
                $lang = Lang::getDefaultLang();
            }

            unset($params['lang_id']);
        } else {
            //Если не указан параметр языка, то работаем с текущим языком
            $lang = Lang::getCurrent();
        }

        $url = parent::createUrl($params);

        return $url == '/' ? '/' . $lang->url : '/' . $lang->url . $url;
    }

}
