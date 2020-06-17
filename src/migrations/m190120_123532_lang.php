<?php

use ashch\sitecore\migrations\Migration;

/**
 * Class m190120_123532_lang
 */
class m190120_123532_lang extends Migration
{

    protected $table_id = 'lang';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable($this->table_name, [
            'id' => $this->primaryKey()->unsigned()->notNull()->Comment('ID'),
            'url' => 'char(3) COLLATE utf8_bin NOT NULL COMMENT "Locale"',
            'locale' => 'char(10) COLLATE utf8_bin NOT NULL COMMENT "Locale"',
            'name' => $this->string(50)->Comment('Name'),
            'short_name' => $this->string(10)->Comment('Short name'),
            'default' => $this->tinyInteger()->unsigned()->Comment('Default'),
            'active' => $this->tinyInteger()->unsigned()->Comment('Active'),
            'created_at' => $this->integer()->unsigned()->Comment('Created at:'),
            'updated_at' => $this->integer()->unsigned()->Comment('Updated at:'),
            "UNIQUE (`locale`)"
                ], $this->tableOptions);
    }

}
