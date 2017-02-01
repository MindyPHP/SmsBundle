<?php

namespace Mindy\Bundle\SmsBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Mindy\Bundle\SmsBundle\Model\Sms;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170201180909 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->createTable(Sms::tableName());
        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('to', 'string', ['length' => 11]);
        $table->addColumn('text', 'text');
        $table->addColumn('created_at', 'datetime');
        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable(Sms::tableName());
    }
}
