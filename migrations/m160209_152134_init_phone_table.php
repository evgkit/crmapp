<?php

use yii\db\Schema;
use yii\db\Migration;

class m160209_152134_init_phone_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'phone',
            [
                'id'          => 'pk',
                'customer_id' => 'int unique',
                'number'      => 'string'
            ],
            'ENGINE=InnoDB'
        );

        $this->addForeignKey('customer_phone_numbers', 'phone', 'customer_id', 'customer', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('customer_phone_numbers', 'phone');
        $this->dropTable('phone');
    }
}
