<?php


namespace Experius\DonationProduct\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * Class UpgradeData
 * @package Experius\Configurator\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var EavSetupFactory
     */
    private $categorySetupFactory;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param CategorySetupFactory $categorySetupFactory
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        CategorySetupFactory $categorySetupFactory,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $fieldList = [
                'tax_class_id',
            ];
            foreach ($fieldList as $field) {
                $applyTo = explode(
                    ',',
                    $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $field, 'apply_to')
                );
                if (!in_array('donation', $applyTo)) {
                    $applyTo[] = 'donation';
                    $eavSetup->updateAttribute(
                        \Magento\Catalog\Model\Product::ENTITY,
                        $field,
                        'apply_to',
                        implode(',', $applyTo)
                    );
                }
            }
        }

        $setup->endSetup();
    }
}
