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

namespace Experius\DonationProduct\Controller\Adminhtml\Charity;

use Experius\DonationProduct\Helper\Data;
/**
 * Class Index
 * @package Experius\DonationProduct\Controller\Adminhtml\Charity
 */
class Import extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    /**
     * @var \Magento\Catalog\Api\Data\ProductInterface
     */
    protected $productInterface;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param \Magento\Catalog\Api\Data\ProductInterface $productInterface
     */

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Api\Data\ProductInterface $productInterface
    ) {
        $this->productRepository = $productRepository;
        $this->productInterface = $productInterface;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();

        $product = $this->productInterface;

        $product->setTypeId(data::DONATION_OPTION_CODE);
        $product->setName('test4');
        $product->setStatus(1);
        $product->setVisibility(4);
        $product->setSku(time());
        $product->setAttributeSetId(4);

        $this->productRepository->save($product);

        $this->messageManager->addSuccessMessage('Email send to ' . $email);

        return $resultRedirect->setPath('*/*/');
    }
}
