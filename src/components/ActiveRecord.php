<?php

namespace ashch\sitecore\components;

use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(
                parent::behaviors(), [
            TimestampBehavior::className(),
            CreatorEditorBehavior::className(),
                ]
        );
    }

}
