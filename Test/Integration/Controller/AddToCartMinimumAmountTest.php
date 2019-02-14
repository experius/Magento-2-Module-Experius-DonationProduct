<?php

namespace DonationProduct;

use Magento\Framework\Data\Form\FormKey;

class AddToCartMinimumAmountTest extends \Magento\TestFramework\TestCase\AbstractController
{

    public static function loadFixture()
    {
        include __DIR__ . '/../_files/product_donation.php';
    }

    public function addAddProductDataProvider()
    {
        return [
            'frontend' => ['frontend', 'donation_amount' => 0.5],
            'adminhtml' => ['adminhtml', 'donation_amount' => 0.5]
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
    public function testAddToCartMinimumAmountDonationProduct($area, $donationAmount)
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

        $this->assertArrayHasKey(
            'backUrl',
            json_decode($this->getResponse()->getBody(), true),
            'Add to cart failed. Expect a backUrl'
        );

        $this->assertSessionMessages($this->equalTo(['Donation amount lower then minimal amount']));
    }
}
