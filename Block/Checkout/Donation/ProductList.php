<?php

namespace Experius\DonationProduct\Block\Checkout\Donation;

use Magento\Catalog\Block\Product\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;

class ProductList
{
    protected $donationHelper;

    protected $searchCriteriaBuilder;

    protected $sortOrder;

    protected $productRepository;

    public function __construct(
        Context $context,
        DonationHelper $donationHelper,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;

        parent::__construct(
            $context,
            $data
        );
    }

    public function getProductCollection()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('type_id', 'donation', 'eq')
            ->addFilter('status', 1, 'eq')
            ->setPageSize(10)
            ->setCurrentPage(1)
            ->addSortOrder($this->sortOrder->setDirection('DESC')->setField('name'))
            ->create();

        $products = $this->productRepository->getList($searchCriteria);

        return $products->getItems();
    }

}
