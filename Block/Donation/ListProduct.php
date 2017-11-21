<?php

namespace Experius\DonationProduct\Block\Donation;

use Magento\Framework\View\Element\Template\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Checkout\Helper\Cart as CartHelper;
use Magento\Catalog\Block\Product\ImageBuilder;

class ListProduct extends \Magento\Framework\View\Element\Template
{
    protected $donationHelper;

    protected $searchCriteriaBuilder;

    protected $sortOrder;

    protected $productRepository;

    protected $cartHelper;

    private $imageBuilder;

    public function __construct(
        DonationHelper $donationHelper,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Context $context,
        CartHelper $cartHelper,
        ImageBuilder $imageBuilder,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
        $this->cartHelper = $cartHelper;
        $this->imageBuilder = $imageBuilder;

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
        return $this->cartHelper->getAddUrl($product, $additional);
    }


    /**
     * Retrieve product image
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param array $attributes
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create();
    }

    public function getFixedAmounts()
    {
        return $this->donationHelper->getFixedAmounts();
    }

    public function getCurrencySymbol()
    {
        return $this->donationHelper->getCurrencySymbol();
    }

    public function useAjaxAddToCart()
    {
        return $this->getData('ajax_add_to_cart');
    }
}
