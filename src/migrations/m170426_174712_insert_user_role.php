<?php

class m170426_174712_insert_user_role extends \yii\db\Migration
{

    public function up()
    {
        //'{{%rbac_auth_item}}'
        $this->insert(Yii::$app->authManager->itemTable, [
            'name' => 'superadmin',
            'type' => '1',
            'description' => '',
            'rule_name' => NULL,
            'data' => 1555555555,
            'created_at' => 1555555555,
            'updated_at' => 1555555555,
        ]);

        //'{{%rbac_auth_assignment}}'
        $this->insert(Yii::$app->authManager->assignmentTable, [
            'item_name' => 'superadmin',
            'user_id' => '1',
            'created_at' => 1555555555,
        ]);
    }

    public function down()
    {
        
    }

}
