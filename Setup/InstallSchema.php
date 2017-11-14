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

        $tableExperiusDonationProductDonations = $setup->getConnection()->newTable(
            $setup->getTable('experius_donations')
        );

        $tableExperiusDonationProductDonations->addColumn(
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

        $tableExperiusDonationProductDonations->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'name'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'sku',
            Table::TYPE_TEXT,
            255,
            [],
            'sku'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'order_item_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'order_item_id'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'order_id'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'order_status',
            Table::TYPE_TEXT,
            null,
            [],
            'order_status'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'amount',
            Table::TYPE_DECIMAL,
            '12,4',
            [],
            'amount'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'invoiced',
            Table::TYPE_BOOLEAN,
            null,
            [],
            'invoiced'
        );

        $tableExperiusDonationProductDonations->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [],
            'Creation date'
        );

        $setup->getConnection()->createTable($tableExperiusDonationProductDonations);

        $setup->endSetup();
    }
}
