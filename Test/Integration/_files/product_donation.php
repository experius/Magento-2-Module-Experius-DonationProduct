<?php

/**
 * @var \Magento\Catalog\Model\Product $product
 */

$product = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(\Magento\Catalog\Model\Product::class);

$product
    ->setTypeId(\Experius\DonationProduct\Model\Product\Type\Donation::TYPE_CODE)
    ->setId(999)
    ->setAttributeSetId(4)
    ->setWebsiteIds([1])
    ->setName('Donation Product')
    ->setSku('donation-product')
    ->setExperiusDonationMinAmount(2)
    ->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
    ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
    ->save();
