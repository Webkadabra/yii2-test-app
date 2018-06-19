<?php

use yii\db\Migration;

/**
 * Class m180619_104352_add_address_pk
 */
class m180619_104352_add_address_pk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `address`
MODIFY COLUMN `id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ;

");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180619_104352_add_address_pk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180619_104352_add_address_pk cannot be reverted.\n";

        return false;
    }
    */
}
