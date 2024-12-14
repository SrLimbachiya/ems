<?php

use yii\db\Migration;

/**
 * Class m241214_073303_db_setup
 */
class m241214_073303_db_setup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241214_073303_db_setup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241214_073303_db_setup cannot be reverted.\n";

        return false;
    }
    */
}
