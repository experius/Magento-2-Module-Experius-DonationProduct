<?php

namespace Experius\DonationProduct\Block\Checkout\Donation;

use Magento\Framework\View\Element\Template\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Checkout\Helper\Cart as CartHelper;

class ListProduct extends \Magento\Framework\View\Element\Template
{
    protected $donationHelper;

    protected $searchCriteriaBuilder;

    protected $sortOrder;

    protected $productRepository;

    protected $cartHelper;

    public function __construct(
        DonationHelper $donationHelper,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Context $context,
        CartHelper $cartHelper,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
        $this->cartHelper = $cartHelper;

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

    public function getProductCollectionArray()
    {
        $products = [];
        foreach ($this->getProductCollection() as $productId => $product) {
            $products[$productId] = $product->getData();
        }

        return $products;
    }


    public function getAddToCartUrl($product, $additional = [])
    {
//        if (!$product->getTypeInstance()->isPossibleBuyFromList($product)) {
//            if (!isset($additional['_escape'])) {
//                $additional['_escape'] = true;
//            }
//            if (!isset($additional['_query'])) {
//                $additional['_query'] = [];
//            }
//            $additional['_query']['options'] = 'cart';
//
//            return $this->getProductUrl($product, $additional);
//        }
        return $this->cartHelper->getAddUrl($product, $additional);
    }
}
