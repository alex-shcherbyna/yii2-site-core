<?php

use ashch\sitecore\migrations\Migration;

/**
 * Class m190907_141446_widget
 */
class m190907_141446_widget extends Migration
{

    protected $table_id = 'widget';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey()->unsigned()->notNull()->Comment('ID'),
            'slug' => $this->string(30)->Comment('Slug'),
            'widget_class' => $this->string(30)->Comment('Widget Class'),
            'name' => $this->string(50)->Comment('Name'),
            'description' => $this->text()->Comment('Description'),
            'active' => $this->tinyInteger()->unsigned()->defaultValue('0')->Comment('Active'),
            'sorting' => $this->smallInteger()->defaultValue('0')->Comment('Sorting'),
            'image' => $this->string(250)->Comment('Image'),
            'created_by' => $this->integer()->unsigned()->Comment('Created by:'),
            'updated_by' => $this->integer()->unsigned()->Comment('Updated by:'),
            'created_at' => $this->integer()->unsigned()->Comment('Created at:'),
            'updated_at' => $this->integer()->unsigned()->Comment('Updated at:'),
        ]);
    }

}
