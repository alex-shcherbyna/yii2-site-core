<?php

namespace ashch\sitecore\widgets;

abstract class Widget extends \yii\bootstrap\Widget
{

    public $data;
    protected $view = 'main';

    public function run()
    {
        return $this->render($this->view, ['data' => $this->data]);
    }

}
