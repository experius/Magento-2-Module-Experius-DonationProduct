<?php

namespace DonationProduct;

use Magento\Framework\Data\Form\FormKey;

class AddToCartTest extends \Magento\TestFramework\TestCase\AbstractController
{

    public static function loadFixture()
    {
        include __DIR__ . '/../_files/product_donation.php';
    }

    public function addAddProductDataProvider()
    {
        return [
            'frontend' => ['frontend', 'donation_amount' => 10],
            'adminhtml' => ['adminhtml', 'donation_amount' => 12]
        ];
    }

    /**
     * Test for \Magento\Checkout\Controller\Cart::execute() with donation product
     *
     * @param string $area
     * @param string $donationAmount;
     * @magentoDataFixture loadFixture
     * @magentoAppIsolation enabled
     * @dataProvider addAddProductDataProvider
     */
    public function testAddToCartDonationProduct($area, $donationAmount)
    {
        $formKey = $this->_objectManager->get(FormKey::class);

        $postData = [
            'qty' => '1',
            'product' => '999',
            'amount' => $donationAmount,
            'form_key' => $formKey->getFormKey(),
            'isAjax' => 1
        ];

        \Magento\TestFramework\Helper\Bootstrap::getInstance()->loadArea($area);

        $this->getRequest()->setPostValue($postData);

        $quote = $this->_objectManager->create(\Magento\Checkout\Model\Cart::class);

        /** @var \Magento\Checkout\Controller\Cart\Add $controller */
        $controller = $this->_objectManager->create(\Magento\Checkout\Controller\Cart\Add::class, [$quote]);
        $controller->execute();

        $this->assertContains(json_encode([]), $this->getResponse()->getBody());

        $items = $quote->getItems()->getItems();

        $this->assertTrue(is_array($items), 'Quote doesn\'t have any items');

        $this->assertCount(1, $items, 'Expected quote items not equal to 1');

        $item = reset($items);

        $this->assertEquals(999, $item->getProductId(), 'Quote has more than one product');
        $this->assertEquals($donationAmount, $item->getPrice(), 'Expected product price failed');
    }
}
