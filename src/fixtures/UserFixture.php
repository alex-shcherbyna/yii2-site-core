<?php

namespace ashch\sitecore\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{

    public $modelClass = 'common\models\User';
    public $dataFile = '@vendor/a-shch/yii2-site-core/src/fixtures/data/User.php';

}
