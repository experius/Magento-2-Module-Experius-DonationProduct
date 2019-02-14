<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/logo.png" width="30%" title="Product Page">
</p>

<h1>Magento 2 Module Experius DonationProduct (RC1.0)</h1>

- Demo website: https://donationproduct.experius.nl
- Magento Marketplace: https://marketplace.magento.com/experius-module-donationproduct.html

<h2>Installation</h2>

Add the module to your composer.json
```composer require experius/module-donationproduct "~1.0.0"```

Run the Magento Setup Upgrade
```bin/magento setup:upgrade```

Install Sample Data (optional)

A number of international charities will be created for testing purposes

(Oxfam, Greenpeace, Save the Children, Amnesty International, World Wildlife Fund)

```bin/magento experius_donationproduct:sampledata:deploy```

Remove Sample Data (optional)

```bin/magento experius_donationproduct:sampledata:remove```

<h2>Frontend</h2>

- This module adds a new product type "Donation Product" to your Magento 2 installation.
- A customer can add this donation product to the cart with a self chosen amount.

The donation products can be viewed on several standard locations in your Magento 2 webshop
- Homepage
- Sidebar
- Cart
- Checkout

Off course it is possible to implement this block on any location by a Magento frontend developer. Or in a cms of category layout update via the Magento Admin. Xml example is provided in the 'Full Size Block' chapter.

When clicked on a charity of the customers choice a popup will open with the charities details and a add to cart button. 

You can also create a regular category with all the donation products with a regular product detail page.

A "Donation Product" has a lot in common with a "Virtual Product". It has no stock, weight and doesn't need a shipping method or address to be set in the checkout.

<h4>Donation Popup</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-modal.png" width="50%" title="Product Page">
</p>

<h4>Product Page</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-page.png" width="50%" title="Product Page">
</p>

<h4>Category Page</h4>

To view the donation products in a category (just like the screenshot below). Create a category in the Magento Admin and add the donation products to that category. 

- Categories can be added in Magento Admin > Catalog > Categories
- After the category is made add the products to the Category via the 'Products in Category' tab. 

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/category-view.png" width="50%" title="Product Page">
</p>

<h4>Sidebar Block</h4>

This block wil be visible on every page wich has a layout with a sidebar implemented. 
It can be disabled in the settings. See settings chapter.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-sidebar.png" title="Product Page">
</p>

<h4>Full Size Block (Homepage)</h4>

The full size block is visible on the homepage. It can be disabled in the settings. See settings chapter.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-full-size.png" width="50%" title="Product Page">
</p>

- A frontend Magento developer can implement this in custom position in you template by using the following xml.
- You can also use the xml below to add the block to a cms page. For example your 404 page. Edit the cms page and add the xml to the 'Design' tab > 'Layout Update XML' field.

```xml
<referenceContainer name="content">
  <block class="Experius\DonationProduct\Block\Donation\ListProduct" name="donation.block" after="-" template="Experius_DonationProduct::donation.phtml"/>
</referenceContainer>  
```

<h4>Checkout Block</h4>

The checkout donation block is visible in the checkout totals block. It can be disabled in the settings. See settings chapter.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-checkout.png" width="50%" title="Checkout Donation">
</p>

<h4>Cart Page</h4>

The cart page donation block is visible on the cart page. It can be disabled in the settings. See settings chapter.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/cart.png" width="50%" title="Cart Page">
</p>

<h2>Backend</h2>

<h4>Product Type</h4>

Add a new product with type 'Donation Product'

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-type-donation.png" width="50%" title="Product Type">
</p>

<h4>Edit Product</h4>

You can configure the minimum donation amount.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-setting.png" width="50%" title="Product Setting">
</p>

<h4>Report</h4>

Reports > Sales > Donations

A report table is made to store every single "Donation Product" sale. You can make an export, sum up the amount per charity and transfer the money.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/report.png" width="50%" title="Report">
</p>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/report-grid.png" width="100%" title="Report Grid">
</p>

<h4>Settings</h4>

Stores > Settings > Configuration > Catalog > Donation Product

There is a setting to enable or disable the complete module.
There are settings to enable and disable the visibility of blocks on several locations in your webshop.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/settings.png" width="50%" title="Settings">
</p>

<h4>Uninstall</h4>

Follow the step below to uninstall the module.

1. Login in to Magento
2. Go to Catalog > Products. Filter on product type 'Donation Product'
3. Delete all the Products with the type 'Donation Product'
4. Go to System > Attributes > Product 
5. Search the attribute 'experius_donation_min_amount' (Minimal Donation Amount) and delete it
6. Run the following in the command line ```bin/magento module:uninstall Experius_DonationProduct``` 

<h4>FAQ</h4>

<b><i>Can i combine the 'Donation product options' with 'Custom options / Customizable Options'?</i></b>

Although its not supported, it can be done! You have change the following template by overwriting it with your own custom template version.
vendor/magento/module-catalog/view/frontend/templates/product/view/form.phtml. You probaly have to hide or remove a duplicate addtocart button

The donation product uses the 'product_info_form_content' container. This is only rendered when no 'Custom options' are found.
```php 
<?php if (!$block->hasOptions()):?>
    <?= $block->getChildHtml('product_info_form_content') ?>
<?php else:?>
    <?php if ($_product->isSaleable() && $block->getOptionsContainer() == 'container1'):?>
        <?= $block->getChildChildHtml('options_container') ?>
    <?php endif;?>
<?php endif; ?>
```

If you want to render both 'Custom options' and 'Donation options'. Change the if statement.

```php 
<?php if (!$block->hasOptions() || $_product->getTypeId()=='donation'):?>
    <?= $block->getChildHtml('product_info_form_content') ?>
<?php else:?>
    <?php if ($_product->isSaleable() && $block->getOptionsContainer() == 'container1'):?>
        <?= $block->getChildChildHtml('options_container') ?>
    <?php endif;?>
<?php endif; ?>
```
