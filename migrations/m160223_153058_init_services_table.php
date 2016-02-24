<?php

use yii\db\Migration;

class m160223_153058_init_services_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'service',
            [
                'id' => 'pk',
                'name' => 'string unique',
                'hourly_rate' => 'integer'
            ]
        );
    }

    public function down()
    {
        $this->dropTable('service');
    }
}
