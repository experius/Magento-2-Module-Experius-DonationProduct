<?php
/**
 * A Magento 2 module named Experius/DonationProduct
 * Copyright (C) 2017 Derrick Heesbeen
 *
 * This file is part of Experius/DonationProduct.
 *
 * Experius/DonationProduct is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\DonationProduct\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Experius\DonationProduct\Setup
 */
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

        $tableExperiusDonationProductDonations->addIndex(
            $installer->getIdxName('experius_donations', ['order_item_id']),
            ['order_item_id']
        );

        $setup->getConnection()->createTable($tableExperiusDonationProductDonations);

        $setup->endSetup();
    }
}
