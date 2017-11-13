<?php


namespace Experius\DonationProduct\Setup;

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
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'name'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'sku',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'sku'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'amount',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            [],
            'amount'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'order_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'order_id'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'order_status',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'order_status'
        );
        

        
        $table_experius_donationproduct_donations->addColumn(
            'invoiced',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'invoiced'
        );
        

        $setup->getConnection()->createTable($table_experius_donationproduct_donations);

        $setup->endSetup();
    }
}
