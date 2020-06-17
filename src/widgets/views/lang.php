<?php
/*
 * TODO:
 * Add switch for Lang widget
 * [CUR] + [lng1, lng2, etc]
 * [lng1, +lng2, lng3]
 */
use yii\helpers\Html;

$lang2cur = strtoupper(substr(Yii::$app->language, 0,2));
?>
<ul class="language-list pull-right">
        <?php foreach ($langs as $lang): ?>
            <li><a href="<?= '/' . $lang->url . Yii::$app->getRequest()->getLangUrl(); ?>" title="<?= $lang->name; ?>" <?= ($current->url == $lang->url)? 'class="current"':''; ?>><?= $lang->short_name; ?></a></li>
        <?php endforeach; ?>
</ul>
 