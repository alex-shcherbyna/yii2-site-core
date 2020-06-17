<?php

/**
 * Description of MenuHelper
 *
 * @author alex
 */

namespace ashch\sitecore\helpers;

use Yii;

class MenuHelper
{

    protected static $urlItems = null;

    public static function isActiveMenu($params = [], $url)
    {
        if (!is_array(self::$urlItems)) {
            self::$urlItems = explode('/', $url);
        }
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                if (empty(self::$urlItems[$key])) {
                    return false;
                }
                if ($value != self::$urlItems[$key]) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
