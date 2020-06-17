<?php

namespace ashch\sitecore\widgets;

use ashch\sitecore\models\Lang;

class WLang extends \yii\bootstrap\Widget
{

    public $view;

    const VIEW_DEFAULT = 'lang';

    public function run()
    {
        if (empty($this->view)) {
            $this->view = self::VIEW_DEFAULT;
        }

        return $this->render($this->view, [
                    'current' => Lang::getCurrent(),
                    'langs' => Lang::find()->where(['active' => 1])->all(),
        ]);
    }

}
