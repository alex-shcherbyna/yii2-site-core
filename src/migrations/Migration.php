<?php

namespace ashch\sitecore\migrations;

use yii\db\Migration AS BaseMigration;

/**
 * Description of Migration
 *
 * @author alex
 */
class Migration extends BaseMigration
{

    /**
     * @var string|null
     */
    protected $table_name;

    /**
     * @var string|null
     */
    protected $table_id;

    /**
     * @var string|null
     */
    protected $optionsDefault; // = 'ENGINE InnoDB';
    /**
     * @var string|null
     */
    protected $tableOptions;

    /**
     *
     */
    public function init()
    {
        parent::init();
        if ('mysql' === $this->db->driverName) {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $this->optionsDefault = 'ENGINE InnoDB';
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->table_id)) {
            $this->table_name = '{{%' . $this->table_id . '}}';
        }
    }

    public function safeDown()
    {
        $this->dropTable($this->table_name);
//        return false;
    }

    public function createTable($table, $columns, $options = null)
    {
        if (empty($options) AND ! empty($this->optionsDefault)) {
            $options = $this->optionsDefault;
        }
        return parent::createTable($table, $columns, $options);
    }

}
