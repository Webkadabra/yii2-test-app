<?php

use yii\db\Migration;

/**
 * Class m180619_103144_add_address_fields
 */
class m180619_103144_add_address_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `address`
ADD COLUMN `phone_no`  varchar(255) NULL AFTER `country`,
ADD COLUMN `fax_no`  int NULL AFTER `phone_no`,
ADD COLUMN `email`  varchar(255) NULL AFTER `fax_no`,
ADD COLUMN `vat`  varchar(255) NULL AFTER `email`;
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180619_103144_add_address_fields cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180619_103144_add_address_fields cannot be reverted.\n";

        return false;
    }
    */
}
