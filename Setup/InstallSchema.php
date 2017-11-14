<?php

namespace Experius\DonationProduct\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_experius_donationproduct_donations = $setup->getConnection()->newTable($setup->getTable('experius_donations'));

        $table_experius_donationproduct_donations->addColumn(
            'donations_id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );

        $table_experius_donationproduct_donations->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'name'
        );

        $table_experius_donationproduct_donations->addColumn(
            'sku',
            Table::TYPE_TEXT,
            255,
            [],
            'sku'
        );

        $table_experius_donationproduct_donations->addColumn(
            'amount',
            Table::TYPE_DECIMAL,
            '12,4',
            [],
            'amount'
        );

        $table_experius_donationproduct_donations->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'order_id'
        );

        $table_experius_donationproduct_donations->addColumn(
            'order_status',
            Table::TYPE_TEXT,
            null,
            [],
            'order_status'
        );

        $table_experius_donationproduct_donations->addColumn(
            'invoiced',
            Table::TYPE_BOOLEAN,
            null,
            [],
            'invoiced'
        );

        $table_experius_donationproduct_donations->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [],
            'Creation date'
        );

        $setup->getConnection()->createTable($table_experius_donationproduct_donations);

        $setup->endSetup();
    }
}
